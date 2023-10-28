<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    //
    public function create(Request $request)
    {
        $cart = DB::table('cart')->where('email', session()->get('user_email'))->get();
        $insert = null;
        if ($request->coupen != "") {
            foreach ($cart as $item) {
                $total = $item->Product_price * $item->Quantity;

                $insert =  DB::table('purchase_item')->insert([
                    'email' => session()->get('user_email'),
                    'address' => $request->address,
                    'Product_id' => $item->Product_id,
                    'Product_name' => $item->Product_name,
                    'Product_price' => $item->Product_price,
                    'Product_size' => $item->Product_size,
                    'Product_for' => $item->Product_for,
                    'Product_category' => $item->Product_category,
                    'Quantity' => $item->quantity,
                    'total' => $total,
                    'FullTotal' => $request->grandTotal,
                    'image' => $item->Product_image,
                    'status' => 'purchased',
                    'coupen' => $request->coupen,
                    'purchased_date' => today(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'Purchased successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error in purchasing the items']);
            }
        } else {
            foreach ($cart as $item) {
                $total = $item->Product_price * $item->quantity;

                $insert =  DB::table('purchase_items')->insert([
                    'email' => session()->get('user_email'),
                    'address' => $request->address,
                    'Product_id' => $item->Product_id,
                    'Product_name' => $item->Product_name,
                    'Product_price' => $item->Product_price,
                    'Product_size' => $item->Product_size,
                    'Product_for' => $item->Product_for,
                    'Product_category' => $item->Product_category,
                    'Quantity' => $item->quantity,
                    'total' => $total,
                    'FullTotal' => $request->grandTotal,
                    'image' => $item->Product_image,
                    'status' => 'purchased',
                    'coupen' => null,
                    'purchased_date' => today(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                if ($insert) {
                    DB::table('cart')->where('email', session()->get('user_email'))->delete();
                    return response()->json(['status' => 'success', 'message' => 'Purchased successfully']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'Error in purchasing the items']);
                }
            }
        }
    }
}
