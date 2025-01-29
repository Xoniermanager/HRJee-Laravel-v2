<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait CompanyScope
{
    protected static function bootCompanyScope()
    {
        static::addGlobalScope('company_scope', function (Builder $builder) {
            if (!Auth::check()) {
                return;
            }
            $user = Auth::user();
            if ($user->type === 'employee') {
                $builder->whereIn('created_by', [$user->company_id, $user->id]);
            } else if ($user->type === 'company') {
                $builder->where('company_id', $user->company_id);
            }
        });
    }
}
