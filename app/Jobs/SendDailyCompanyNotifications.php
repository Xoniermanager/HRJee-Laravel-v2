<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Policy;
use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Http\Services\SendNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendDailyCompanyNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $today = Carbon::today();

        // get today's active items with relations
        $announcements = Announcement::with(['designations', 'departments', 'companyBranches'])
            ->whereDate('start_date_time', $today)
            ->where('status', 1)
            ->get();

        $newsList = News::with(['designations', 'departments', 'companyBranches'])
            ->whereDate('start_date', $today)
            ->where('status', 1)
            ->get();

        $policies = Policy::with(['designations', 'departments', 'companyBranches'])
            ->whereDate('start_date', $today)
            ->where('status', 1)
            ->get();

        foreach ([$announcements, $newsList, $policies] as $items) {
            foreach ($items as $item) {
                $companyId = $item->company_id;

                // Build user query base: active, company, has fcm_token
                $query = User::query()
                    ->where('type', 'user')
                    ->where('company_id', $companyId)
                    ->where('status', 1)
                    ->whereNotNull('fcm_token');

                // Branches
                if ($item->all_company_branch != 1) {
                    $branchIds = $item->companyBranches->pluck('id')->toArray();
                    if (!empty($branchIds)) {
                        $query->whereHas('details', function ($q) use ($branchIds) {
                            $q->whereIn('company_branch_id', $branchIds);
                        });
                    }
                }

                // Departments
                if ($item->all_department != 1) {
                    $departmentIds = $item->departments->pluck('id')->toArray();
                    if (!empty($departmentIds)) {
                        $query->whereHas('details', function ($q) use ($departmentIds) {
                            $q->whereIn('department_id', $departmentIds);
                        });
                    }
                }

                // Designations
                if ($item->all_designation != 1) {
                    $designationIds = $item->designations->pluck('id')->toArray();
                    if (!empty($designationIds)) {
                        $query->whereHas('details', function ($q) use ($designationIds) {
                            $q->whereIn('designation_id', $designationIds);
                        });
                    }
                }

                // get target users
                $users = $query->get(['id', 'name', 'fcm_token']);
                foreach ($users as $user) {
                    $title = "New " . class_basename($item); // e.g., Announcement, News, Policy
                    $body = "Dear {$user->name}, there is a new {$title}: {$item->title}.";
                    // Send notification (also log in DB if you want inside sendNotification)
                    SendNotification::send(
                        $user->fcm_token,
                        $title,
                        $body,
                        [
                            'item_id' => $item->id,
                            'item_type' => class_basename($item)
                        ],
                        $user->id
                    );
                }
            }
        }
    }
}
