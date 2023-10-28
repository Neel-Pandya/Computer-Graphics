<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //
    public function insertIntoCart(Request $request)
    {


        // Check if the item exists in the cart
        $existingCartItem = DB::table('cart')
            ->where('email', $request->email)
            ->where('Product_id', $request->Product_id)
            ->first();

        if ($existingCartItem) {
            // If the item already exists, update its quantity
            $newQuantity = $existingCartItem->quantity + $request->Quantity;

            if ($newQuantity > 10) {
                return response()->json(['status' => 'failed', 'message' => 'Quantity limit exceeded']);
            } else {
                $updateQuantity = DB::table('cart')
                    ->where('email', $request->email)
                    ->where('Product_id', $request->Product_id)
                    ->update(['quantity' => $newQuantity]);

                if ($updateQuantity) {
                    return response()->json(['status' => 'updated', 'message' => 'Quantity updated']);
                }
            }
        } else {
            // If the item doesn't exist, insert a new record into the cart
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
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($insertRecordIntoTheCart) {
                return response()->json(['status' => 'success', 'message' => 'Product Added to cart successfully']);
            }
        }
    }

    public function getCartDetails()
    {
        $cart = DB::table('cart')->where('email', session()->get('user_email'))->get();
        return response()->json(['status' => 'details', 'details' => $cart]);
    }

    // Handle any other cases here (e.g., if neither insertion nor update is successful)

    public function updateCartQuantity(Request $request)
    {
        $newQuantity = $request->input('quantity');

        $update = DB::table('cart')->where('product_id', $request->id)->update(['quantity' => $newQuantity]);

        return $update ? response()->json(['status' => 'success', 'newQuantity' => $newQuantity]) : response()->json(['status' => 'error']);
    }
    public function delete($id)
    {
        $delete = DB::table('cart')->where('id', $id)->delete();
        return $delete ? response()->json(['status' => 'success', 'message' => 'cart item deleted successfully']) : response()->json(['status' => 'failed', 'message' => 'error in deleting cart item']);
    }

    public function applyCoupenCode(Request $request)
    {
        $grandTotal = $request->total;
        $coupen = $request->coupen;

        $checkIfExists = DB::table('coupens')->where('coupen_name', $coupen)->where('status', 'Active')->first();
        if ($checkIfExists) {
            $applied_coupen = session()->get('applied_coupen');
            if ($applied_coupen === $coupen) {
                return response()->json(['status' => 'failed', 'message' => 'coupen already used']);
            } else {
                $checkIsNotExpired = DB::table('coupens')->where('coupen_name', $coupen)->where('expire_date', '<>', today())->where('expire_date', '>', today())->where('status', 'Active')->first();
                if ($checkIsNotExpired) {
                    $ifQuantityNotZero = DB::table('coupens')->where('coupen_name', $coupen)->where('Quantity', '<>', 0)->first();
                    if ($ifQuantityNotZero) {
                        $discount = DB::table('coupens')->where('coupen_name', $coupen)->select('discount', 'Quantity')->first();
                        $explode = explode('%', $discount->discount);
                        $mainTotal = $grandTotal * (1 - ($explode[0] / 100));
                        $updatedQuantity = $discount->Quantity;
                        $update =  DB::table('coupens')->where('coupen_name', $coupen)->update(['Quantity' =>  $updatedQuantity - 1]);


                        if ($update) {
                            session()->put('applied_coupen',  $coupen);
                            return response()->json(['status' => 'success', 'total' => $mainTotal]);
                        } else {
                            return response()->json(['status' => 'failed', 'message' => 'Error in applying the coupen']);
                        }
                    } else {
                        return response()->json(['status' => 'failed', 'message' => 'Coupen is finished']);
                    }
                } else {
                    DB::table('coupens')->where('coupen_name', $coupen)->update(['status' => 'Inactive']);
                    return response()->json(['status' => 'failed', 'message' => 'Coupen is expired Already']);
                }
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Coupen does not exists']);
        }
    }
}
