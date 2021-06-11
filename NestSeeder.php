<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Pterodactyl\Services\Nests\NestCreationService;
use Pterodactyl\Contracts\Repository\NestRepositoryInterface;

class NestSeeder extends Seeder
{
    /**
     * @var \Pterodactyl\Services\Nests\NestCreationService
     */
    private $creationService;

    /**
     * @var \Pterodactyl\Contracts\Repository\NestRepositoryInterface
     */
    private $repository;

    /**
     * NestSeeder constructor.
     */
    public function __construct(
        NestCreationService $creationService,
        NestRepositoryInterface $repository
    ) {
        $this->creationService = $creationService;
        $this->repository = $repository;
    }

    /**
     * Run the seeder to add missing nests to the Panel.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    public function run()
    {
        $items = $this->repository->findWhere([
            'author' => 'support@oxide.host',
        ])->keyBy('name')->toArray();

        $this->createDiscordBotHostingNest(array_get($items, 'Discord Bot Hosting'));
    }

    /**
     * Create the Discord Bot Hosting nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createDiscordBotHostingNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Discord Bot Hosting',
                'description' => 'Oxide Hosting: Virtual Private Server - Pterodactyl Eggs.',
            ], 'support@oxide.host');
        }
    }
}
