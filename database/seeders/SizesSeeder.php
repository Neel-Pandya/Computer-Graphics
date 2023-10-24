<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sizes')->insert([
            'size_name' => 'X',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'XL',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'XXL',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'XXXL',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'S',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'L',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sizes')->insert([
            'size_name' => 'M',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
