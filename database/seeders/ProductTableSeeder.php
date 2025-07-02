<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->delete();

        $productTypes = [
            'Business Installment Loan',
            'Small Business Loan',
            'Personal Loan',
            'Home Loan',
            'Loan Against Property',
            'Loan Against Securities',
            'Working Capital Overdraft',
            'Life Insurance Policy',
            'Unsecured Overdraft',
            'Education Loan',
            'Cross sell Life Insurance',
            'Cross sell Health Insurance',
            'Cross sell Motor Insurance',
            'Credit Card',
        ];

        $now = Carbon::now();
        $products = [];

        foreach ($productTypes as $index => $type) {
            $id = $index + 1;
            $loanProductId = 'LP' . str_pad($id, 10, '0', STR_PAD_LEFT);

            $products[] = [
                'id' => $id,
                'loan_product_id' => $loanProductId,
                'type' => $type,
                'status' => 1,
                'company_id' => 1,
                'created_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('products')->insert($products);
    }
}
