<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create a user with plain text password
        // User::create([
        //     'name' => 'Puneet',
        //     'email' => 'admin@gmail.com',
        //     'emp_id' => '1234',
        //     'password' => Hash::make('admin123') // Hash the password
        // ]);
        
        // You can add more users as needed
    }
}
?>
