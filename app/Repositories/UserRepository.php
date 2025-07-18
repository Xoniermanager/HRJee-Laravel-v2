<?php

namespace App\Repositories;
use Carbon\Carbon;
use App\Models\User;
use App\Models\EmployeeManager;
use App\Models\UserLiveLocation;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function fetchEmployeesCurrentLocation(array $userIds)
    {
        $locations = UserLiveLocation::whereIn('user_id', $userIds)->get();

        return $locations;
    }

    public function fetchLocationsOfEmployee(
        string $userId,
        ?string $date,
        ?int $onlyStayPoints = 0,
        ?int $onlyNewPoints = 0,
        $punchOutTime = null
    ) {
        $date = $date ?? Carbon::now()->toDateString();

        $query = UserLiveLocation::where('user_id', $userId)
            ->where('company_id', auth()->user()->company_id)
            ->where('created_at', '>=', Carbon::parse("{$date} 00:00:00"))
            ->where('created_at', '<=', Carbon::parse($punchOutTime))
            ->select(['id', 'latitude', 'longitude', 'created_at', 'read']);

        if ($onlyNewPoints) {
            $query->where('read', 0);
        }

        $locations = $query->get();

        // Mark fetched locations as read
        if ($locations->isNotEmpty()) {
            UserLiveLocation::whereIn('id', $locations->pluck('id'))->update(['read' => 1]);
        }

        if ($onlyStayPoints) {
            $locations = get_stay_points($locations->toArray(), $punchOutTime);
        }

        return $locations;
    }

    public function saveCurrentLocationsOfEmployee(array $locations)
    {
        $data = [];
        foreach ($locations as $location) {
            $data[] = [
                'user_id' => auth()->id(),
                'company_id' => auth()->user()->company_id,
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        UserLiveLocation::insert($data);
    }

    public function boot()
    {
        // Apply a default condition
        $this->pushCriteria(app(RequestCriteria::class));


        $this->scopeQuery(function ($query) {
            if (!Auth::check()) {
                return $query;
            }
            $user = Auth::user();
            if ($user->userRole && $user->userRole->category === 'custom') {
                $userIDs = EmployeeManager::where('manager_id', $user->id)->pluck('user_id');
                return $query->whereIn('id', $userIDs);
             }
            return $query;
        });
    }
}
