<?php

namespace App\Repositories;
use App\Models\User;
use App\Models\UserLiveLocation;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

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
        ?int $onlyNewPoints = 0, $punchOutTime = null
    ) {
        $date = $date ?? Carbon::now()->toDateString();

        $query = UserLiveLocation::where('user_id', $userId)
            ->where('company_id', auth()->user()->company_id)
            ->where('created_at', '>=', Carbon::parse("{$date} 00:00:00"))
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
}
