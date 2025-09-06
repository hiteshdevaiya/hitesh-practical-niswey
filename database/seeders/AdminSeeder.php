<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@yopmail.com',
            'password' => bcrypt('Admin@123'),
        ]);
    }
}
