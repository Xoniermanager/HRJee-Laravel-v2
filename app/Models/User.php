<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'company_id',
        'manager_id',
        'type',
        'status',
        'reset_password',
        'created_by'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id', 'company_id');
    }

    public function userRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function menu()
    {
        if($this->role) {
            return $this->role->belongsToMany(Menu::class)->orderBy('order_no', 'asc')->with(['children']);
        } else {
            return $this->userRole->belongsToMany(Menu::class)->orderBy('order_no', 'asc')->with(['children']);
        }
    }

    public function menus()
    {
        if ($this->role_id) {
            $menusIDs = MenuRole::where('role_id', $this->role_id)->pluck('menu_id')->toArray();

            return Menu::whereIn('id', $menusIDs)->with(['children'])->get()->toArray();
        } else {

            return [];
        }
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
        );
    }

    public function details()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function companyDetails()
    {
        if($this->type == "company") {
            return $this->hasOne(CompanyDetail::class, 'user_id');
        } else {
            return $this->belongsTo(CompanyDetail::class, 'company_id', 'user_id');
        }
    }
    
    public function userCompanyDetails()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id', 'id')->with('user');
    }
    public function addressDetails()
    {
        return $this->hasMany(UserAddressDetail::class, 'user_id');
    }

    public function bankDetails()
    {
        return $this->hasOne(UserBankDetail::class, 'user_id');
    }

    public function advanceDetails()
    {
        return $this->hasOne(UserAdvanceDetail::class, 'user_id');
    }
    public function ctcDetails()
    {
        return $this->hasOne(UserCtcDetail::class, 'user_id');
    }

    public function managers()
    {
        return $this->hasMany(EmployeeManager::class, 'user_id');
    }

    public function managerEmployees()
    {
        return $this->hasMany(EmployeeManager::class, 'manager_id', 'id');
    }

    public function pastWorkDetails()
    {
        return $this->hasMany(UserPastWorkDetail::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function documentDetails()
    {
        return $this->hasMany(UserDocumentDetail::class, 'user_id', 'id');
    }

    public function qualificationDetails()
    {
        return $this->hasMany(UserQualificationDetail::class, 'user_id', 'id');
    }

    public function familyDetails()
    {
        return $this->hasMany(UserRelativeDetail::class, 'user_id', 'id');
    }
    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'user_skill', 'user_id', 'skill_id');
    }

    public function language()
    {
        return $this->belongsToMany(Languages::class, 'langauge_user', 'user_id', 'language_id')->withPivot('read', 'write', 'speak');
    }

    public function assetDetails()
    {
        return $this->hasMany(UserAsset::class, 'user_id', 'id')->where('returned_date', '=', null);
    }

    public function hasPermission($permissionName)
    {
        return $this->role->permissions()->where('name', $permissionName)->exists();
    }

    public function resignationLogs()
    {
        return $this->morphMany(ResignationLog::class, 'actionTakenBy');
    }

    public function todaysAttendance()
    {
        $attendance = EmployeeAttendance::where('user_id', $this->id)->whereDate('punch_in', date('Y-m-d'))->first();

        return $attendance;
    }

    public function todaysLeave()
    {
        $leave = Leave::where('user_id', $this->id)->whereDate('from', '<=', date('Y-m-d'))
            ->whereDate('to', '>=', date('Y-m-d'))->first();

        return $leave;
    }

    protected static function booted()
    {
        parent::booted();

        static::created(function ($companyCreated) {
            // \Log::info("New Company Created: " . $companyCreated);
            if ($companyCreated->type == 'company') {
                $companyCreated->handlePostCreationActions();
            }
        });
    }
    public function handlePostCreationActions()
    {
        // When Company is Created So we created the salary component entry
        $payload = [
            [
                'name' => 'Basic pay',
                'default_value' => '50',
                'is_taxable' => '1',
                'value_type' => 'percentage',
                'is_default' => '1',
                'earning_or_deduction' => 'earning',
                'company_id' => $this->id,  // Use $this->id for the current company
                'created_by' => $this->id,   // Use $this->id for the current company
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Special allowance',
                'default_value' => '0',
                'is_taxable' => '1',
                'value_type' => 'fixed',
                'is_default' => '1',
                'earning_or_deduction' => 'earning',
                'company_id' => $this->id,  // Use $this->id for the current company
                'created_by' => $this->id,  // Use $this->id for the current company
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        SalaryComponent::insert($payload);
    }

    public function userActiveLocation()
    {
        return $this->hasOne(UserActiveLocation::class, 'user_id')->where('status', true);
    }

    public function userReward()
    {
        return $this->hasMany(UserReward::class, 'user_id', 'id');
    }

    // Relationship: A user can have multiple employees
    public function employees()
    {
        return $this->hasMany(EmployeeManager::class, 'manager_id');
    }

    // Relationship: A user can have one manager
    public function manager()
    {
        return $this->belongsTo(EmployeeManager::class, 'id', 'user_id');
    }

    public function currentLocations($userIDs) {
        $today = Carbon::today();

        return UserLiveLocation::whereIn('user_id', $userIDs)->whereDate('created_at', $today)
        ->latest('created_at')->with('user');
    }

    public function currentPunchInLocations($userIDs) {
        $today = Carbon::today();

        return EmployeeAttendance::whereIn('user_id', $userIDs)->whereDate('created_at', $today)
        ->latest('created_at')->with('user');
    }

    public function getPreviousMonthAttendanceWithLeave($month, $year)
    {
        $userId = $this->id;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        // End date (last day of the month)
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        // $startDate = Carbon::now()->subMonth()->startOfMonth();
        // $endDate = Carbon::now()->subMonth()->endOfMonth();

        // Fetch attendance and leaves for the user for the previous month
        $attendances = EmployeeAttendance::where('user_id', $userId)
        ->whereBetween('punch_in', [$startDate->toDateString(), $endDate->toDateString()])
        ->get()
        ->groupBy(function ($item) {
            return Carbon::parse($item->punch_in)->toDateString();
        });

        $leaves = Leave::where('user_id', $userId)
        ->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('from', [$startDate, $endDate])
                ->orWhereBetween('to', [$startDate, $endDate])
                ->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('from', '<', $startDate)
                        ->where('to', '>', $endDate);
                });
        })
        ->get();

        $report = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dateStr = $date->toDateString();
            $status = 'Absent';
            $details = null;

            // Check attendance
            if (isset($attendances[$dateStr])) {
                $status = 'Present';
                $details = $attendances[$dateStr];
            } else {
                // Check if on leave
                $leave = $leaves->first(function ($leave) use ($dateStr) {
                    return $dateStr >= $leave->from && $dateStr <= $leave->to;
                });

                if ($leave) {
                    $status = 'On Leave';
                    $details = [
                        'leave_type_id' => $leave->leave_type_id,
                        'leave_status_id' => $leave->leave_status_id,
                        'is_half_day' => $leave->is_half_day,
                        'reason' => $leave->reason,
                    ];
                }
            }

            $report[] = [
                'date' => $dateStr,
                'status' => $status,
                'details' => $details,
            ];
        }

        return $report;
    }

    public function totalCompanyEmployees() {

        return User::where('type', 'user')->where('company_id', $this->id)->count();
    }

    public function totalActiveEmployees() {
        
        return User::where(['type' => 'user', 'status' => 1])->where('company_id', $this->id)->count();
    }

    public function countTodayPunchIns()
    {
        return EmployeeAttendance::join('users', 'users.id', '=', 'employee_attendances.user_id')
            ->where('users.company_id', $this->id)
            ->whereDate('employee_attendances.punch_in', Carbon::today())
            ->count();
    }

    public function totalInActiveEmployees() {
        
        return User::where(['type' => 'user', 'status' => 0])->where('company_id', $this->id)->count();
    }

}
