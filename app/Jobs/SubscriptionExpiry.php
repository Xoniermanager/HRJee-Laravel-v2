<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use App\Mail\SubscriptionExpiry as SubscriptionExpiryMail;
use App\Models\CompanyDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SubscriptionExpiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {}
    public function handle()
    {
        try {

            $expiredDate = date('Y-m-d', strtotime('+7 days'));
            $subscriptionExpiredCompanies = CompanyDetail::with('user', 'subscriptionPlan')->where('subscription_expiry_date', '<=', $expiredDate)->get();

            foreach ($subscriptionExpiredCompanies as $item) {

                Mail::to($item->user->email)->send(new SubscriptionExpiryMail($item->subscription_expiry_date, $item->username, $item->user->email));

            }
        } catch (\Exception $e) {
            \Log::error('Error sending file: ' . $e->getMessage());
        }
    }
}
