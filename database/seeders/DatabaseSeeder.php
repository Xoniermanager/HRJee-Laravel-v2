<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminTableSeeder::class);
        $this->call(CompanyTypesTableSeeder::class);
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
        $this->call(CompanyTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LeaveStatusesTableSeeder::class);
        $this->call(NewsCategoriesTableSeeder::class);
        $this->call(LeaveTypesTableSeeder::class);
        $this->call(PolicyCategoriesTableSeeder::class);
        $this->call(ResignationStatusTableSeeder::class);
        $this->call(ComplainStatusesTableSeeder::class);
        $this->call(ComplainCategoriesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(CompanyBranchesTableSeeder::class);
         $this->call(OfficeTimingConfigsTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        $this->call(CompanyDetailsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(MenuRoleTableSeeder::class);
        $this->call(UserDetailsTableSeeder::class);
        $this->call(UserSkillTableSeeder::class);
        $this->call(LangaugeUserTableSeeder::class);
        $this->call(AssetManufacturersTableSeeder::class);
        $this->call(AssetStatusesTableSeeder::class);
        $this->call(AssetCategoriesTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
        $this->call(UserAddressesDetailsTableSeeder::class);
        $this->call(UserAdvanceDetailsTableSeeder::class);
        $this->call(UserBankDetailsTableSeeder::class);
        $this->call(UserDocumentDetailsTableSeeder::class);
        $this->call(UserPastWorkDetailsTableSeeder::class);
        $this->call(UserQualificationDetailsTableSeeder::class);
        $this->call(UserRelativeDetailsTableSeeder::class);
        $this->call(UserAssetsTableSeeder::class);
        $this->call(BreakTypesTableSeeder::class);
        // $this->call(RoleHasPermissionsTableSeeder::class);
        // $this->call(PermissionSeeder::class);
        // $this->call(HolidaysTableSeeder::class);
        // // $this->call(AnnouncementsTableSeeder::class);
        // $this->call(WeekendsTableSeeder::class);
        // $this->call(CompanyMenuTableSeeder::class);
        $this->call(EmployeesMenusSeeder::class);
        $this->call(SalariesTableSeeder::class);
        $this->call(SalaryComponentsTableSeeder::class);
        $this->call(SalaryComponentAssignmentsTableSeeder::class);
        $this->call(TaxSlabRulesTableSeeder::class);
        $this->call(UserCtcDetailsTableSeeder::class);
        $this->call(UserCtcHistoriesTableSeeder::class);
        $this->call(UserCtcComponentHistoriesTableSeeder::class);
        $this->call(FormsTableSeeder::class);
        $this->call(FormFieldsTableSeeder::class);
        $this->call(DispositionCodesTableSeeder::class);
        $this->call(AssignTasksTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(CurriculaTableSeeder::class);
        $this->call(CurriculamAssignmentsTableSeeder::class);
        $this->call(EmployeeLeaveAvailablesTableSeeder::class);
        $this->call(UserActiveLocationsTableSeeder::class);
        $this->call(RewardCategoriesTableSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);
    }
}
