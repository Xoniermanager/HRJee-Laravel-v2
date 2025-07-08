<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackfillCompanyDefaultRoles extends Command
{
    protected $signature = 'backfill:company-default-roles';
    protected $description = 'Backfill default roles for all companies';

    public function handle()
    {
        $companies = User::where('type', 'company')->get();
        $this->info("Found {$companies->count()} companies.");

        foreach ($companies as $company) {
            DB::beginTransaction();
            try {
                $this->info("Processing company: {$company->name}");

                $roles = Role::where('company_id', $company->id)
                             ->where('category', 'default')
                             ->get();

                $companyPrefix = $company->name . ' ';

                // ------------------ Admin ------------------
                $adminRole = $roles->first(function ($role) use ($companyPrefix) {
                    return $role->name === $companyPrefix . 'Admin' || $role->name === 'Admin';
                });

                if ($adminRole) {
                    if ($adminRole->name !== 'Admin') {
                        $adminRole->name = 'Admin';
                        $adminRole->save();
                        $this->info("✔ Renamed existing '{$adminRole->name}' to 'Admin' for company {$company->name}");
                    } else {
                        $this->info("✔ 'Admin' role already exists for company {$company->name}");
                    }
                } else {
                    Role::create([
                        'company_id' => $company->id,
                        'created_by' => $company->id,
                        'name' => 'Admin',
                        'category' => 'default',
                    ]);
                    $this->info("✔ Created missing 'Admin' role for company {$company->name}");
                }

                // ------------------ HR ------------------
                $hrRole = $roles->firstWhere('name', 'HR');
                if ($hrRole) {
                    $this->info("✔ 'HR' role already exists for company {$company->name}");
                } else {
                    Role::create([
                        'company_id' => $company->id,
                        'created_by' => $company->id,
                        'name' => 'HR',
                        'category' => 'default',
                    ]);
                    $this->info("✔ Created missing 'HR' role for company {$company->name}");
                }

                // ------------------ Employee ------------------
                $employeeRole = $roles->firstWhere('name', 'Employee');
                if ($employeeRole) {
                    $this->info("✔ 'Employee' role already exists for company {$company->name}");
                } else {
                    Role::create([
                        'company_id' => $company->id,
                        'created_by' => $company->id,
                        'name' => 'Employee',
                        'category' => 'default',
                    ]);
                    $this->info("✔ Created missing 'Employee' role for company {$company->name}");
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("✖ Failed for company {$company->name}: {$e->getMessage()}");
            }
        }

        $this->info('🎉 Backfill complete!');
        return 0;
    }
}
