<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

    public function getProductsForMale()
    {
        $products = DB::table('products')->where('Product_for', 'Male')->where('Product_status', 'Active')->get();
        if ($products->count() > 0) {
            return response()->json(['status' => 'success', 'products' => $products]);
        }
    }

    public function getProductsForFemale()
    {
        $products = DB::table('products')->where('Product_for', 'Female')->where('Product_status', 'Active')->get();
        if ($products->count() > 0) {
            return response()->json(['status' => 'success', 'products' => $products]);
        }
    }
}
