<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefundController extends Controller
{
    //
    public function getRefund(string $id)
    {
        $getSpecificProduct = DB::table('purchase_items')->select('image')->find($id);
        return response()->json(['status' => 'success', 'product' => $getSpecificProduct]);
    }

    public function createRefundProduct(Request $request)
    {
        $refundProducts = DB::table('refunds')->insert([
            'user_id' => $request->id,
            'user_message' => $request->refund,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if ($refundProducts) {
            DB::table('purchase_items')->where('id', $request->id)->update(['status' => 'refund request sent...']);
            return response()->json(['status' => 'success', 'message' => 'refund request sent successfully']);
        } else {
            return response()->json(['status' => 'success', 'message' => 'error in sending the refund request']);
        }
    }

    public function getRefundRequests()
    {
        $refunds = DB::table('refunds')
            ->join('purchase_items', 'refunds.user_id', '=', 'purchase_items.id')
            ->select('refunds.*', 'purchase_items.*')
            ->get();

        return response()->json(['status' => 'success', 'data' => $refunds]);
    }

    public function approveRefunds(string $id)
    {
        $refundRequest = DB::table('refunds')->where('user_id', $id)->first();

        if ($refundRequest) {
            // Update the status of the corresponding purchase item to 'refunded'
            $updated = DB::table('purchase_items')->where('id', $refundRequest->user_id)->update(['status' => 'refunded']);

            if ($updated) {
                DB::table('refunds')->delete($refundRequest->id);
                return response()->json(['status' => 'success', 'message' => 'Refund request approved and purchase item status updated.']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Failed to update the purchase item status.']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Refund request not found.']);
        }
    }
    public function declineRefunds(string $id)
    {
        $refundRequest = DB::table('refunds')->where('user_id', $id)->first();

        if ($refundRequest) {
            // Update the status of the corresponding purchase item to 'refunded'
            $updated = DB::table('purchase_items')->where('id', $refundRequest->user_id)->update(['status' => 'declined']);

            if ($updated) {
                DB::table('refunds')->delete($refundRequest->id);
                return response()->json(['status' => 'success', 'message' => 'Refund request declined']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Failed to update the purchase item status.']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Refund request not found.']);
        }
    }
}
