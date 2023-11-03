<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    //
    public function create(Request $request)
    {
        $insert =  DB::table('rating')->insert([
            'user_email' => session()->get('user_email'),
            'rating' => $request->rate,
            'review' => $request->review,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $insert ? response()->json(['status' => 'success', 'message' => 'Review Submitted successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in Submitting the Review']);
    }

    public function getRateReview()
    {
        $rating = DB::table('rating')->get();
        return response()->json(['status' => 'success', 'rating' => $rating]);
    }
}
