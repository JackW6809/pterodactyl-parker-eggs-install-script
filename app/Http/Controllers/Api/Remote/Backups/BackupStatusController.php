<?php

namespace Pterodactyl\Http\Controllers\Api\Remote\Backups;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Pterodactyl\Models\Backup;
use Pterodactyl\Models\Server;
use Pterodactyl\Models\AuditLog;
use Illuminate\Http\JsonResponse;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Pterodactyl\Exceptions\DisplayException;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Extensions\Backups\BackupManager;
use Pterodactyl\Repositories\Eloquent\BackupRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Pterodactyl\Http\Requests\Api\Remote\ReportBackupCompleteRequest;

class BackupStatusController extends Controller
{
    /**
     * @var \Pterodactyl\Repositories\Eloquent\BackupRepository
     */
    private $repository;

    /**
     * @var \Pterodactyl\Extensions\Backups\BackupManager
     */
    private $backupManager;

    /**
     * BackupStatusController constructor.
     */
    public function __construct(BackupRepository $repository, BackupManager $backupManager)
    {
        $this->repository = $repository;
        $this->backupManager = $backupManager;
    }

    /**
     * Handles updating the state of a backup.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function index(ReportBackupCompleteRequest $request, string $backup)
    {
        /** @var \Pterodactyl\Models\Backup $model */
        $model = Backup::query()->where('uuid', $backup)->firstOrFail();

        if (!is_null($model->completed_at)) {
            throw new BadRequestHttpException('Cannot update the status of a backup that is already marked as completed.');
        }

        $action = $request->input('successful')
            ? AuditLog::SERVER__BACKUP_COMPELTED
            : AuditLog::SERVER__BACKUP_FAILED;

        $model->server->audit($action, function (AuditLog $audit) use ($model, $request) {
            $audit->is_system = true;
            $audit->metadata = ['backup_uuid' => $model->uuid];

            $successful = $request->input('successful') ? true : false;
            $model->fill([
                'is_successful' => $successful,
                'checksum' => $successful ? ($request->input('checksum_type') . ':' . $request->input('checksum')) : null,
                'bytes' => $successful ? $request->input('size') : 0,
                'completed_at' => CarbonImmutable::now(),
            ])->save();

            // Check if we are using the s3 backup adapter. If so, make sure we mark the backup as
            // being completed in S3 correctly.
            $adapter = $this->backupManager->adapter();
            if ($adapter instanceof AwsS3Adapter) {
                $this->completeMultipartUpload($model, $adapter, $successful);
            }
        });

        return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Handles toggling the restoration status of a server. The server status field should be
     * set back to null, even if the restoration failed. This is not an unsolvable state for
     * the server, and the user can keep trying to restore, or just use the reinstall button.
     *
     * The only thing the successful field does is update the entry value for the audit logs
     * table tracking for this restoration.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function restore(Request $request, string $backup)
    {
        /** @var \Pterodactyl\Models\Backup $model */
        $model = Backup::query()->where('uuid', $backup)->firstOrFail();
        $action = $request->get('successful')
            ? AuditLog::SERVER__BACKUP_RESTORE_COMPLETED
            : AuditLog::SERVER__BACKUP_RESTORE_FAILED;

        // Just create a new audit entry for this event and update the server state
        // so that power actions, file management, and backups can resume as normal.
        $model->server->audit($action, function (AuditLog $audit, Server $server) use ($backup) {
            $audit->is_system = true;
            $audit->metadata = ['backup_uuid' => $backup];
            $server->update(['status' => null]);
        });

        return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Marks a multipart upload in a given S3-compatiable instance as failed or successful for
     * the given backup.
     *
     * @throws \Exception
     * @throws \Pterodactyl\Exceptions\DisplayException
     */
    protected function completeMultipartUpload(Backup $backup, AwsS3Adapter $adapter, bool $successful)
    {
        // This should never really happen, but if it does don't let us fall victim to Amazon's
        // wildly fun error messaging. Just stop the process right here.
        if (empty($backup->upload_id)) {
            // A failed backup doesn't need to error here, this can happen if the backup encouters
            // an error before we even start the upload. AWS gives you tooling to clear these failed
            // multipart uploads as needed too.
            if (!$successful) {
                return;
            }
            throw new DisplayException('Cannot complete backup request: no upload_id present on model.');
        }

        $params = [
            'Bucket' => $adapter->getBucket(),
            'Key' => sprintf('%s/%s.tar.gz', $backup->server->uuid, $backup->uuid),
            'UploadId' => $backup->upload_id,
        ];

        $client = $adapter->getClient();
        if (!$successful) {
            $client->execute($client->getCommand('AbortMultipartUpload', $params));

            return;
        }

        // Otherwise send a CompleteMultipartUpload request.
        $params['MultipartUpload'] = [
            'Parts' => $client->execute($client->getCommand('ListParts', $params))['Parts'],
        ];

        $client->execute($client->getCommand('CompleteMultipartUpload', $params));
    }
}
