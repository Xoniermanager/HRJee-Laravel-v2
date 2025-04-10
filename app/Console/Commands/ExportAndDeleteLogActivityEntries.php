<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\LogActivity;
use App\Mail\LogActivityReport;
use Illuminate\Console\Command;
use App\Exports\LogActivityExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ExportAndDeleteLogActivityEntries extends Command
{
    protected $signature = 'entries:export-delete';
    protected $description = 'Export old Log Activity, send email, delete the file, and remove from database';

    public function handle()
    {
        if (!LogActivity::where('created_at', '<', Carbon::now()->subWeek())->exists()) {
            $this->info("No log entries found. Skipping export.");
            return false;
        }
        $startDate = Carbon::now()->subWeek()->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');
        $fileName = "log_activity_{$startDate}_to_{$endDate}.csv";
        $filePath = storage_path("app/exports/{$fileName}");

        // Export logs to CSV
        Excel::store(new LogActivityExport, "exports/{$fileName}");

        // Send email with attachment
        Mail::to('arjun@xoniertechnologies.com')->send(new LogActivityReport($filePath));

        // Delete the file after sending
        Storage::delete("exports/{$fileName}");

        // Delete old log entries
        LogActivity::where('created_at', '<', Carbon::now()->subWeek())->delete();

        $this->info("Log activity exported to {$fileName}, emailed, and deleted successfully.");
    }

}
