<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    //

    public function getProfile()
    {
        $adminProfile = DB::table('admin')->select('admin_profile')->get();

        return response()->json(['status' => 'success', 'profile' => $adminProfile]);
    }
}
