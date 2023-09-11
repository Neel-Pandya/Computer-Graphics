<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function guest_create()
    {

        return view('guest.index');
    }
    public function guest_products()
    {
        $productData = DB::table('products')->where('Product_status', 'Active')->get();
        return view('guest.products', compact('productData'));
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
        $request->validate(
            [
                'customer_name' => 'required',
                'customer_email' => 'required|email',
                'customer_password' => 'required|confirmed',
                'customer_password_confirmation' => 'required',
                'customer_gender' => 'required',
                'customer_number' => 'required|numeric|digits:10',
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
            ],
        );
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
    public function login_validate(Request $request){
        $request->validate([
                'customer_email' => 'required|email',
                'customer_password' => 'required',
        ],[
            'customer_email.required' => 'email field is required',
            'customer_password.required' => 'Password field is required',
            'customer_email.email' => 'Email field must be type of email'
        ]) ;
    }
}
