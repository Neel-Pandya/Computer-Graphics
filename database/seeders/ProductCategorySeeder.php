<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'category_name' => 'Shoes',
            'status' => 'Active'
        ]);


        DB::table('categories')->insert([
            'category_name' => 'Jeans',
            'status' => 'Active'
        ]);


        DB::table('categories')->insert([
            'category_name' => 'Shirt',
            'status' => 'Active'
        ]);


        DB::table('categories')->insert([
            'category_name' => 'Dress',
            'status' => 'Active'
        ]);
    }
}
