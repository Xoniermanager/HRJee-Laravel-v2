<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Policy;
use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use App\Http\Services\SendNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendDailyCompanyNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        // Fetch only unsent items (is_sent = 0) active today
        $announcements = Announcement::with(['designations', 'departments', 'companyBranches'])
            ->where('status', 1)
            ->where('is_sent', 0)
            ->whereDate('start_date_time', '<=', $today)
            ->whereDate('expires_at_time', '>=', $today)
            ->get();

        $newsList = News::with(['designations', 'departments', 'companyBranches'])
            ->where('status', 1)
            ->where('is_sent', 0)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->get();

        $policies = Policy::with(['designations', 'departments', 'companyBranches'])
            ->where('status', 1)
            ->where('is_sent', 0)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->get();

        // Process all items
        foreach ([$announcements, $newsList, $policies] as $items) {
            foreach ($items as $item) {
                $companyId = $item->company_id;

                // Base user query: active users with fcm_token
                $query = User::query()
                    ->where('type', 'user')
                    ->where('company_id', $companyId)
                    ->where('status', 1)
                    ->whereNotNull('fcm_token');

                // Filter by branches if needed
                if ($item->all_company_branch != 1) {
                    $branchIds = $item->companyBranches->pluck('id')->toArray();
                    if (!empty($branchIds)) {
                        $query->whereHas('details', function ($q) use ($branchIds) {
                            $q->whereIn('company_branch_id', $branchIds);
                        });
                    }
                }

                // Filter by departments if needed
                if ($item->all_department != 1) {
                    $departmentIds = $item->departments->pluck('id')->toArray();
                    if (!empty($departmentIds)) {
                        $query->whereHas('details', function ($q) use ($departmentIds) {
                            $q->whereIn('department_id', $departmentIds);
                        });
                    }
                }

                // Filter by designations if needed
                if ($item->all_designation != 1) {
                    $designationIds = $item->designations->pluck('id')->toArray();
                    if (!empty($designationIds)) {
                        $query->whereHas('details', function ($q) use ($designationIds) {
                            $q->whereIn('designation_id', $designationIds);
                        });
                    }
                }

                // Get target users
                $users = $query->get(['id', 'name', 'fcm_token']);

                foreach ($users as $user) {
                    $typeName = class_basename($item); // e.g., Announcement, News, Policy
                    $title = "New {$typeName}";
                    $body = "Dear {$user->name}, there is a new {$typeName}: {$item->title}.";

                    // Send notification
                    SendNotification::send(
                        $user->fcm_token,
                        $title,
                        $body,
                        [
                            'item_id' => $item->id,
                            'item_type' => $typeName
                        ],
                        $user->id
                    );
                }

                // ✅ Mark as sent
                $item->update(['is_sent' => 1]);
            }
        }
    }
}
