<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function getAllProducts()
    {
        $userProducts = DB::table('purchase_items')->get();
        if ($userProducts->count() > 0) {
            return response()->json(['status' => 'success', 'data' => $userProducts]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Oops no record found']);
        }
    }

    public function getProductsForMale(string $search = null)
    {

        if ($search != "") {
            $products = DB::table('products')->where('Product_status', 'Active')->where('Product_category',  "$search%")->orWhere('Product_name', 'like', $search)->orWhere('Product_price', $search)->orWhere('Product_category', $search)->orWhere('Product_size', $search)->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        } else {
            $products = DB::table('products')->where('Product_status', 'Active')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }
    }

    public function filterByGenders(string $gender = null, string $size = null)
    {
        if ($gender != "") {
            $products = DB::table('products')->where('Product_for', $gender)->where('Product_status', 'Active')->get();
        } else {
            $products = DB::table('products')->where('Product_status', 'Active')->get();
        }
        return response()->json(['status' => 'success', 'products' => $products]);
    }

    public function getAllSize()
    {
        return response()->json(['status' => 'success', 'products' => DB::table('sizes')->where('status', 'Active')->get()]);
    }
}
