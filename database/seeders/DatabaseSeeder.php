<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Company::create([
            'name' => 'Xonier',
            'username' => 'Xonier',
            'contact_no' => '1234567890',
            'email' => 'xonier@gmail.com',
            'role_id' => null, // You might want to adjust this if you have a specific role ID
            'joining_date' => Carbon::now(),
            'logo' => 'https://ibb.co/YPHW7WK',
            'company_size' => '100', // or any other size
            'company_url' => 'https://yourcompany.com',
            'subscription_id' => 1, // You might want to adjust this
            'company_address' => 'XYZ',
            'industry_type' => '5',
            'status' => '1', // or any other status
        ]);
        CompanyUser::insert([
            'company_id' => '1',
            'email' => 'xonier@gmail.com',
            'name' => 'Xonier',
            'password' => Hash::make('password') // <---- check this
        ]);
        $this->call(CountryTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(PreviousCompaniesTableSeeder::class);
        $this->call(QualificationsTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(EmployeeStatusesTableSeeder::class);
        $this->call(EmployeeTypesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(CompanyBranchesTableSeeder::class);
        $this->call(OfficeTimingConfigsTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(LeaveStatusesTableSeeder::class);
        $this->call(AssetManufacturersTableSeeder::class);
        $this->call(AssetStatusesTableSeeder::class);
        $this->call(AssetCategoriesTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserAddressesDetailsTableSeeder::class);
        $this->call(UserAdvanceDetailsTableSeeder::class);
        $this->call(UserBankDetailsTableSeeder::class);
        $this->call(UserDocumentDetailsTableSeeder::class);
        $this->call(UserPastWorkDetailsTableSeeder::class);
        $this->call(UserQualificationDetailsTableSeeder::class);
        $this->call(UserRelativeDetailsTableSeeder::class);
        $this->call(UserAssetsTableSeeder::class);
        $this->call(UserSkillTableSeeder::class);
        $this->call(LangaugeUserTableSeeder::class);
        $this->call(HolidaysTableSeeder::class);
        $this->call(NewsCategoriesTableSeeder::class);
        $this->call(LeaveTypesTableSeeder::class);
        // $this->call(AnnouncementsTableSeeder::class);
        $this->call(PolicyCategoriesTableSeeder::class);
        $this->call(BreakTypesTableSeeder::class);
        $this->call(ResignationStatusTableSeeder::class);
        $this->call(ComplainStatusesTableSeeder::class);
        $this->call(ComplainCategoriesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
    }
}
