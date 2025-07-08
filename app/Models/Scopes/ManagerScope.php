<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait ManagerScope
{
    protected static function bootManagerScope()
    {
        static::addGlobalScope('manager_scope', function (Builder $builder) {
            if (!Auth::check()) {
                return;
            }
            
            if(request()->segment(1) !== "company"){
                return;
            }

            $user = Auth::user();
            if($user->userRole->category === "custom"){
                $users = $user->managerEmployees()->pluck('user_id');
                $builder->whereIn('user_id', $users);
            }
        });
    }
}
