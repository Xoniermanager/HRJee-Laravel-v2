<?php

namespace App\Console\Commands;

use App\Jobs\SubscriptionExpiry;
use Illuminate\Console\Command;

class SubscriptionExpiryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription-expiry-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SubscriptionExpiry::dispatch();
        return Command::SUCCESS;
    }
}
