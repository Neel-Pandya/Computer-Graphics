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
}
