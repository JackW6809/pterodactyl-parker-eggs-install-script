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
            'author' => 'support@pterodactyl.io',
        ])->keyBy('name')->toArray();

        $this->createSourceEngineNest(array_get($items, 'Source Engine'));
        $this->createVoiceServersNest(array_get($items, 'Voice Servers'));
        $this->createRustNest(array_get($items, 'Rust'));
        $this->createAmongUsNest(array_get($items, 'Among Us'));
        $this->createBeamMPNest(array_get($items, 'BeamMP'));
        $this->createBeamNGNest(array_get($items, 'BeamNG'));
        $this->createBotsNest(array_get($items, 'Bots'));
        $this->createCallofDutyNest(array_get($items, 'Call of Duty'));
        $this->createCryoFallNest(array_get($items, 'CryoFall'));
        $this->createDatabaseNest(array_get($items, 'Database'));
        $this->createETLegacyNest(array_get($items, 'Enemy Territory'));
        $this->createFactorioNest(array_get($items, 'Factorio'));
        $this->createFasterThanLightNest(array_get($items, 'Faster Than Light'));
        $this->createGrandTheftAutoNest(array_get($items, 'Grand Theft Auto'));
        $this->createLeagueSandboxNest(array_get($items, 'League Sandbox'));
        $this->createMindustryNest(array_get($items, 'Mindustry'));
        $this->createMinetestNest(array_get($items, 'Minetest'));
        $this->createOpenarenaNest(array_get($items, 'Openarena'));
        $this->createOpenRANest(array_get($items, 'OpenRA'));
        $this->createRedDeadRedemptionNest(array_get($items, 'Red Dead Redemption'));
        $this->createSoftwareNest(array_get($items, 'Software'));
        $this->createStarMadeNest(array_get($items, 'StarMade'));
        $this->createStorageNest(array_get($items, 'Storage'));
        $this->createTeeworldsNest(array_get($items, 'Teeworlds'));
        $this->createTerrariaNest(array_get($items, 'Terraria'));
        $this->createTycoonGamesNest(array_get($items, 'Tycoon Games'));
        $this->createUnrealEngineNest(array_get($items, 'Unreal Engine'));
        $this->createVelorenNest(array_get($items, 'Veloren'));
        $this->createVintageStoryNest(array_get($items, 'Vintage Story'));
        $this->createXonoticNest(array_get($items, 'Xonotic'));
    }

    /**
     * Create the Source Engine Games nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createSourceEngineNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Source Engine',
                'description' => 'Includes support for most Source Dedicated Server games.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Voice Servers nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createVoiceServersNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Voice Servers',
                'description' => 'Voice servers such as Mumble and Teamspeak 3.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Rust nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createRustNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Rust',
                'description' => 'Rust - A game where you must fight to survive.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Among Us nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createAmongUsNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Among Us',
                'description' => 'Among Us - A 2D game where you are either a crewmate completing tasks or an impostor sabotaging the crewmates.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the BeamMP nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createBeamMPNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'BeamMP',
                'description' => 'BeamMP - Allows for stable servers, with a variety of servers located accross the globe.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the BeamNG nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createBeamNGNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'BeamNG',
                'description' => 'BeamNG.drive - An incredibly realistic driving game with near-limitless possibilities.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Bots nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createBotsNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Bots',
                'description' => 'Bots - A variety of different bots to fulfill your needs.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the COD nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createCallofDutyNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Call of Duty',
                'description' => 'Call of Duty - A first-person shooter video game franchise published by Activision.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the CryoFall nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createCryoFallNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'CryoFall',
                'description' => 'CryoFall - A 2D Sci-Fi online survival game set on a forgotten planet in the distant future.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Database nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createDatabaseNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Database',
                'description' => 'Database - A range of different database options to choose from.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Enemy Territory nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createETLegacyNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Enemy Territory',
                'description' => 'Enemy Territory - A free and open-source multiplayer first-person shooter video game set during World War II.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Factorio nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createFactorioNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Factorio',
                'description' => 'Factorio - A 2D construction and management simulation game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Faster Than Light nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createFasterThanLightNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Faster Than Light',
                'description' => 'Faster Than Light - A 2D space-based top-down real-time strategy roguelike game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Grand Theft Auto nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createGrandTheftAutoNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Grand Theft Auto',
                'description' => 'Grand Theft Auto - A series of action-adventure games created by David Jones and Mike Dailly.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the League Sandbox nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createLeagueSandboxNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'League Sandbox',
                'description' => 'League Sandbox - A gameserver for League Of Legends.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Mindustry nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createMindustryNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Mindustry',
                'description' => 'Mindustry - A sandbox tower-defense game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Minetest nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createMinetestNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Minetest',
                'description' => 'Minetest - A free and open-source sandbox video game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Openarena nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createOpenarenaNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Openarena',
                'description' => 'Openarena - A first-person shooter, and a video game clone of Quake III Arena.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the OpenRA nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createOpenRANest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'OpenRA',
                'description' => 'OpenRA - An open source project that recreates and modernizes classic real time strategy games',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Red Dead Redemption nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createRedDeadRedemptionNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Red Dead Redemption',
                'description' => 'Red Dead Redemption - An action-adventure game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Software nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createSoftwareNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Software',
                'description' => 'Software - A range of different software to host.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the StarMade nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createStarMadeNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'StarMade',
                'description' => 'StarMade - An effectively infinite open-universe space simulation sandbox game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Storage nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createStorageNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Storage',
                'description' => 'Storage - A range of storage solutions for your needs.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Teeworlds nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createTeeworldsNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Teeworlds',
                'description' => 'Teeworlds - A free, open-source sidescrolling multiplayer shooting game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Terraria nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createTerrariaNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Terraria',
                'description' => 'Terraria - A 2D action-adventure sandbox game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Tycoon Games nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createTycoonGamesNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Tycoon Games',
                'description' => 'Tycoon Games - A range of different tycoon games.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Unreal Engine nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createUnrealEngineNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Unreal Engine',
                'description' => 'Unreal Engine - A range of different Unreal Engine games.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Veloren nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createVelorenNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Veloren',
                'description' => 'Veloren - A open-source multi-platform voxel action role-playing game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Vintage Story nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createVintageStoryNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Vintage Story',
                'description' => 'Vintage Story - A sandbox survival game.',
            ], 'support@pterodactyl.io');
        }
    }

    /**
     * Create the Xonotic nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createXonoticNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Xonotic',
                'description' => 'Xonotic - A free and open-source first-person shooter video game.',
            ], 'support@pterodactyl.io');
        }
    }
}
