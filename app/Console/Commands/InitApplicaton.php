<?php

namespace App\Console\Commands;

use App\Enums\TierAttributeKey;
use App\Tier;
use Artisan;
use Illuminate\Console\Command;
use function json_encode;

class InitApplicaton extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the application before first run.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Dropping previous tables and migrating');
        Artisan::call('migrate:fresh', [
            '--force' => true,
            '--drop-views' => true,
        ]);

        $this->info('Creating Tiers');
        $this->createTiers();

        return 0;
    }

    /** @noinspection JsonEncodingApiUsageInspection */
    protected function createTiers(): void
    {
        Tier::insert([
            'price' => 'free',
            'name' => 'Free',
            'attributes' => json_encode([
                TierAttributeKey::MAX_SIZE => '500',
            ]),
        ]);
        Tier::insert([
            'price' => '5 EUR',
            'name' => 'Lord',
            'attributes' => json_encode([
                TierAttributeKey::MAX_SIZE => '1500',
            ]),
        ]);
        Tier::insert([
            'price' => '10 EUR',
            'name' => 'King',
            'attributes' => json_encode([
                TierAttributeKey::MAX_SIZE => '5000',
            ]),
        ]);
    }
}
