<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

// // Check if the role already exists
// $role = Role::findByName('super-admin', 'web');

// // If the role doesn't exist, create it
// if (!$role) {
//     $role = Role::create(['name' => 'super-admin']);
// }

// Retrieve all permissions
// $permissions = Permission::get();

// // Assign all permissions to the super admin role
// $role->syncPermissions($permissions);
    }
}
