<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Country;
use App\Models\CompanyBranch;
use App\Models\PushNotification;
use App\Observers\CompanyObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\CompanyBranchObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Schema::defaultStringLength(191);
        Blade::directive('countryName', function ($id) {
            return "<?php echo App\Models\Country::getCountryNameById($id); ?>";
        });
        Blade::directive('stateName', function ($id) {
            return "<?php echo App\Models\State::getStateNameById($id); ?>";
        });
        Company::observe(CompanyObserver::class);
        CompanyBranch::observe(CompanyBranchObserver::class);

        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                if ($user->type === 'company') {
                    // Get notifications for the company
                    $notifications = PushNotification::where('company_id', $user->id)
                        ->where('status', true)
                        ->orderBy('id', 'DESC')
                        ->get();
                } else {
                    // Get notifications for the individual user
                    $notifications = $user->pushNotifications()
                        ->where('status', true)
                        ->orderBy('id', 'DESC')
                        ->take(20)
                        ->get();
                }

                $view->with('globalNotifications', $notifications);
            } else {
                $view->with('globalNotifications', collect());
            }
        });
    }
}
