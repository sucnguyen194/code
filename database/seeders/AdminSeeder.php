<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = Admin::create([
            'name' => 'Administrator',
            'email' => 'spaussio@gmail.com',
            'password' => bcrypt('123@Qaz'),
        ]);

        $admin->assignRole('Administrator');
    }
}
