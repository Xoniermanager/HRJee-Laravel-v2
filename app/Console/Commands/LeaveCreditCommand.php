<?php

namespace App\Console\Commands;

use App\Jobs\CreditLeaveJob;
use Illuminate\Console\Command;

class LeaveCreditCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:leave-credit-command';

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
        CreditLeaveJob::dispatch();
        return Command::SUCCESS;
    }
}
