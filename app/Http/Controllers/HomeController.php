<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function index()
    {
        $admin_data = DB::table('admin')->get();

        return view('pages.home', compact('admin_data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile' => 'required|mimes:png,jpg,jpeg,avif'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'validation', 'message' => $validator->messages()]);
        }
        $fileOriginalName = $request->file('profile')->getClientOriginalName();

        $insert = DB::table('home')->insertOrIgnore([
            'image' => $fileOriginalName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($insert) {
            $request->profile->move('images/products/', $fileOriginalName);
            return response()->json(['status' => 'success', 'message' => 'image added successfully']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Error in storing the image']);
        }
    }
    public function show()
    {
        $homeData = DB::table('home')->get();
        return response()->json(['data' => $homeData]);
    }

    public function activate($id)
    {
        $activate = DB::table('home')->find($id);
        if ($activate) {
            $update = DB::table('home')->where('id', $id)->where('status', 'Inactive')->orWhere('status', 'Deleted')->update(['status' => 'Active']);
            return $update ? response()->json(['status' => 'success', 'message' => 'Status Activated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Error in finding the image']);
        }
    }

    public function deactivate($id)
    {
        $activate = DB::table('home')->find($id);
        if ($activate) {
            $update = DB::table('home')->where('id', $id)->where('status', 'Active')->update(['status' => 'Inactive']);
            return $update ? response()->json(['status' => 'success', 'message' => 'Status Activated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Error in finding the image']);
        }
    }

    public function delete($id)
    {
        $activate = DB::table('home')->find($id);
        if ($activate) {
            $update = DB::table('home')->where('id', $id)->update(['status' => 'Deleted']);
            return $update ? response()->json(['status' => 'success', 'message' => 'Status Activated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Error in finding the image']);
        }
    }
    public function edit($id)
    {
        return response()->json(['editData' => DB::table("home")->find($id)]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile' => 'mimes:png,jpg,avif,jpeg'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'validation', $validator->messages()]);
        }

        if ($request->has('profile')) {
            $filePath = "images/products/$request->profile";
            $fileOriginalName = $request->file('profile')->getClientOriginalName();
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $update = DB::table('home')->where('id', $request->id)->update([
                'image' => $fileOriginalName,

            ]);

            if ($update) {
                $request->profile->move('images/products/', $fileOriginalName);
                return response()->json(['status' => 'success', 'message' => 'Product image updated successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error in updating the product image']);
            }
        } else {
        }
    }
}
