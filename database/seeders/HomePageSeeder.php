<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('home')->insert([
            'image' => 'marcus-loke-xXJ6utyoSw0-unsplash (1).jpg',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
