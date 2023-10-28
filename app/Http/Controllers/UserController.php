<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //

    public function generateRandomToken()
    {
        return Str::random(60); // Generate a longer random token
    }

    public function guest_create()
    {
        $homeData = DB::table('home')->where('id', 1)->where('status', 'Active')->first();
        $homeAllData = DB::table('home')->where('id', '<>', 1)->where('status', 'Active')->get();
        $trending = DB::table('home')->where('status', 'Active')->orderBy('created_at')->get();
        $products = DB::table('products')->where('Product_status', 'Active')->get();
        return view('guest.index', compact('homeData', 'homeAllData', 'trending', 'products'));
    }
    public function guest_products()
    {

        return view('guest.products');
    }
    public function guest_categories()
    {
        $trending = DB::table('products')->where('Product_status', 'Active')->orderBy('created_at')->get();
        $him = DB::table('products')->where('Product_for', 'Male')->get();
        $her = DB::table('products')->where('Product_for', 'Female')->get();
        return view('guest.categories', compact('trending', 'him', 'her'));
    }
    public function guest_contact()
    {
        return view('guest.contact');
    }
    public function guest_login()
    {
        return view('guest.login');
    }
    public function guest_register()
    {
        return view('guest.register');
    }
    public function guest_register_validate(Request $request)
    {


        $mailData = [
            'title' => 'Registration Successful',
            'body' => 'Hello ' . $request->customer_name . ' your account is created successfully. Please click below link to activate your account.',

            // Include the token in the email data
            'email' => $request->customer_email,
        ];
        $request->validate(
            [
                'customer_name' => 'required',
                'customer_email' => 'required|email|unique:customer_registration,customer_email',
                'customer_password' => 'required|confirmed',
                'customer_password_confirmation' => 'required',
                'customer_gender' => 'required',
                'customer_number' => 'required|numeric|digits:10',
                'pic' => 'mimes:jpg,png,jpeg,avif',
            ],
            [
                'customer_name.required' => 'name field is required',
                'customer_email.required' => 'email field is required',
                'customer_password.required' => 'Password field is required',
                'customer_gender.required' => 'gender field is required',
                'customer_password_confirmation' => 'confirm password field is required',
                'customer_number.required' => 'number field is required',
                'customer_email.email' => 'email field must be type of email',
                'customer_password.confirmed' => 'Confirm password field not matched the password field',
                'customer_number.numeric' => 'Number must be numeric',
                'customer_number.digits' => 'Number must have 10 digits',
                'pic.required' => 'Profile picture field is required',
                'pic.mimes' => 'Supported extensions for profile are jpg, png,jpeg,avif',
            ],
        );
        if ($request->has('pic')) {
            $fileOriginalName = $request->file('pic')->getClientOriginalName();
            $customerData = DB::table('customer_registration')->insert([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_mobile' => $request->customer_number,
                'customer_password' => $request->customer_password,
                'customer_gender' => $request->customer_gender,
                'customer_profile' => $fileOriginalName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($customerData) {
                Mail::to($request->customer_email)->send(new RegistrationMail($mailData));
                session()->flash('Success', 'Registration Successfull');
                return redirect()->route('guest.login');
            } else {
                session()->flash('Error', 'Registration Error');
                return redirect()->back();
            }
        } else {
            $customerData = DB::table('customer_registration')->insert([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_mobile' => $request->customer_number,
                'customer_password' => $request->customer_password,
                'customer_gender' => $request->customer_gender,
                'customer_profile' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($customerData) {
                Mail::to($request->customer_email)->send(new RegistrationMail($mailData));
                session()->flash('Success', 'Registration Successfull');
                return redirect()->route('guest.login');
            } else {
                session()->flash('Error', 'Registration Error');
                return redirect()->back();
            }
        }
    }
    public function guest_contact_validate(Request $request)
    {
        $request->validate(
            [
                'customer_name' => 'required',
                'customer_email' => 'required|email',
                'customer_message' => 'required',
            ],
            [
                'customer_name.required' => 'The name Field is Required',
                'customer_email.required' => 'The email field is required',
                'customer_message.required' => 'The message field is required',
                'customer_email.email' => 'The Email Field must be type of email',
            ],
        );
    }
    public function login_validate(Request $request)
    {
        $request->validate(
            [
                'customer_email' => 'required|email',
                'customer_password' => 'required',
            ],
            [
                'customer_email.required' => 'email field is required',
                'customer_password.required' => 'Password field is required',
                'customer_email.email' => 'Email field must be type of email',
            ],
        );
        $count = DB::table('customer_registration')->where('customer_email', $request->customer_email)->where('customer_password', $request->customer_password)->count();
        if ($count == 1) {
            $userData = DB::table('customer_registration')->where('customer_email', $request->customer_email)->where('customer_password', $request->customer_password)->where('customer_status', 'Active')->first();
            if ($userData) {
                session()->put('user_email', $request->customer_email);
                session()->put('user_password', $request->customer_password);
                return redirect()->route('guest.create');
            } else {
                session()->flash('Error', 'Account is not active please activate the account first');
            }
        } else {
            session()->flash('Error', 'User Not Found');
        }
        return redirect()->route('guest.login');
    }

    public function activate_account($email, Request $request)
    {

        $ifUserExists = DB::table('customer_registration')
            ->where('customer_email', $email)
            ->where('customer_status', 'Inactive')
            ->first();
        if ($ifUserExists) {
            $updateStatus = DB::table('customer_registration')
                ->where('customer_email', $email)
                ->update(['customer_status' => 'Active']);
            if ($updateStatus) {
                session()->flash('Success', 'Account Activated Successfully');
                return redirect()->route('guest.login');
            } else {
                session()->flash('Error', 'Error in Account Activation');
                return redirect()->route('guest.login');
            }
        } else {
            session()->flash('Error', 'Error In activating the account');
            return redirect()->route('guest.login');
        }
    }

    public function edit_profile()
    {
        $userData = DB::table('customer_registration')->where('customer_email', session()->get('user_email'))->where('customer_password', session()->get('user_password'))->first();
        return view('guest.edit_profile', compact('userData'));
    }

    public function edit_profile_validate(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_mobile' => 'required|digits:10',
            'customer_profile' => 'mimes:png,jpg,jpeg,avif'
        ]);
        if ($request->has('customer_profile')) {
            $filePath = "images/profiles/$request->customer_profile";
            $fileOriginalName = $request->file("customer_profile")->getClientOriginalName();
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $userData = DB::table('customer_registration')->where('customer_email', $request->customer_email)->update(['customer_name' => $request->customer_name, 'customer_mobile' => $request->customer_mobile, 'customer_profile' => $fileOriginalName]);

            if ($userData) {
                $request->customer_profile->move("images/profiles/", $fileOriginalName);
                session()->flash('Success', 'Profile updated successfully');
            } else {
                session()->flash('Error', 'Error in Updating the profile');
            }
        } else {
            $userData = DB::table('customer_registration')->where('customer_email', $request->customer_email)->update(['customer_name' => $request->customer_name, 'customer_mobile' => $request->customer_mobile]);

            $userData ? session()->flash('Success', 'Profile Updated Successfully') : session()->flash('Error', 'Error in updating the profile');
        }
        return redirect()->route('user.edit.profile');
    }
    public function guest_logout()
    {
        session()->forget('user_email');
        session()->forget('user_password');
        session()->forget('applied_coupen');
        return redirect()->route('guest.login');
    }

    public function change_password_validate(Request $request)
    {
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required|confirmed|min:8|max:16',

            'new_pass_confirmation' => 'required',
        ]);
        if ($request->new_pass == $request->old_pass) {
            session()->flash('Error', 'The new Password cannot be old password');
            return redirect()->route('user.change.password');
        } else {
            $updateQueryForPassword = DB::table('customer_registration')
                ->where('customer_password', $request->old_pass)
                ->update(['customer_password' => $request->new_pass]);
            $updateQueryForPassword ? session()->flash('Success', 'Password Updated Successfully') : session()->flash('Error', 'Error in Updating the password');
            return redirect()->route('user.change.password');
        }
    }
}
