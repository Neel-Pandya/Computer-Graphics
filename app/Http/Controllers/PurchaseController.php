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


        // If coupen is not null
        if ($request->coupen != "") {
            $cartTotal = 0;
            foreach ($cart as $item) {
                $total = $item->Product_price * $item->quantity;
                $cartTotal += $total;
            }

            $coupen = $request->coupen;
            $checkIfExists = DB::table('coupens')->where('coupen_name', $coupen)->where('status', 'Active')->first();

            if ($checkIfExists) {
                $checkIsNotExpired = DB::table('coupens')
                    ->where('coupen_name', $coupen)
                    ->where('expire_date', '<>', today())
                    ->where('expire_date', '>', today())
                    ->where('status', 'Active')
                    ->first();

                if ($checkIsNotExpired) {
                    $ifQuantityNotZero = DB::table('coupens')
                        ->where('coupen_name', $coupen)
                        ->where('Quantity', '<>', 0)
                        ->first();

                    if ($ifQuantityNotZero) {
                        $discount = DB::table('coupens')
                            ->where('coupen_name', $coupen)
                            ->select('discount', 'Quantity')
                            ->first();

                        $explode = explode('%', $discount->discount);
                        $mainTotal = $cartTotal * (1 - ($explode[0] / 100));
                        $updatedQuantity = $discount->Quantity;
                        $update = DB::table('coupens')
                            ->where('coupen_name', $coupen)
                            ->update(['Quantity' => $updatedQuantity - 1]);

                        if ($update) {
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
                                    'FullTotal' => $mainTotal,
                                    'image' => $item->Product_image,
                                    'status' => 'purchased',
                                    'coupen' => $request->coupen,
                                    'purchased_date' => today(),
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);

                                DB::table('cart')->where('email', session()->get('user_email'))->delete();
                            }
                        } else {
                            return response()->json(['status' => 'failed', 'message' => 'Error in applying the coupon']);
                        }
                    } else {
                        return response()->json(['status' => 'failed', 'message' => 'Coupon is finished']);
                    }
                } else {
                    DB::table('coupens')->where('coupen_name', $coupen)->update(['status' => 'Inactive']);
                    return response()->json(['status' => 'failed', 'message' => 'Coupon has expired already']);
                }
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Coupon does not exist']);
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
