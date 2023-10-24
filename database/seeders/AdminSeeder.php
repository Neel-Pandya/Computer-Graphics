<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            'admin_name' => 'Neel Pandya',
            'admin_email' => 'npandya757@rku.ac.in',
            'admin_password' => 'N2479717',
            'admin_profile' => 'default.jpg'
        ]);
    }
}
