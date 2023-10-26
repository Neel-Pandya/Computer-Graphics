<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function insertIntoCart(Request $request)
    {
        $insertRecordIntoTheCart = DB::table('cart')->insert([
            'email' => $request->email,
            'Product_id' => $request->Product_id,
            'Product_name' => $request->Product_name,
            'Product_price' => $request->Product_price,
            'Product_category' => $request->Product_category,
            'Product_for' => $request->Product_for,
            'Product_size' => $request->Product_size,
            'Product_image' => $request->Product_image,
            'quantity' => $request->Quantity,
        ]);

        return $insertRecordIntoTheCart ? response()->json(['status' => 'success', 'message' => 'Product Added to cart successfully']) : response()->json(['status' => 'success', 'message' => 'Error in adding the product into the cart']);
    }
}
