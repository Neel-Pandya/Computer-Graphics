<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('guest.index');
    }
    public function guest_products()
    {
        $productForMale = DB::table('products')
            ->where('Product_status', 'Active')
            ->where('Product_for', 'Male')
            ->get();

        $productForFemale = DB::table('products')
            ->where('Product_status', 'Active')
            ->where('Product_for', 'Female')
            ->get();

        return view('guest.products', compact('productForMale', 'productForFemale'));
    }
    public function guest_categories()
    {
        return view('guest.categories');
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
        $token = $this->generateRandomToken();
        $request->session()->put('token', $token);

        $mailData = [
            'title' => 'Registration Successful',
            'body' => 'Hello ' . $request->customer_name . ' your account is created successfully. Please click below link to activate your account.',
            'token' => $token, // Include the token in the email data
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
        $count = DB::table('customer_registration')->where('customer_email',$request->customer_email)->where('customer_password', $request->customer_password)->count();
        if($count == 1){
            $userData = DB::table('customer_registration')->where('customer_email', $request->customer_email)->where('customer_password', $request->customer_password)->get();

        }
        else{
            echo "not found";
        }
    }

    public function activate_account($email, $token, Request $request)
    {
        $sessionToken = $request->session()->get('token');
        $ifUserExists = DB::table('customer_registration')
            ->where('customer_email', $email)
            ->where('customer_status', 'Inactive')
            ->first();
        if ($token === $sessionToken) {
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
}
