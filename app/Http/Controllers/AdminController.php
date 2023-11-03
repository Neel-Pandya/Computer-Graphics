<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    //
    public function create()
    {
        $orderCount = DB::table('purchase_items')->count();
        $productCount = DB::table('products')->count();
        $customerCount = DB::table('customer_registration')->count();
        $activeUserCount = DB::table('customer_registration')->where('customer_status', 'Active')->count();
        $refundCount = DB::table('purchase_items')->where('status', 'refunded')->count();
        $categoriesCount = DB::table('categories')->where('status', 'Active')->count();
        $registeredCount = DB::table('customer_registration')->count();
        $cancelledRefundCount = DB::table('purchase_items')->where('status', 'declined')->count();
        return view('index', compact('orderCount', 'productCount', 'customerCount', 'activeUserCount', 'refundCount', 'categoriesCount', 'registeredCount', 'cancelledRefundCount'));
    }

    public function products(Request $request)
    {

        return view('pages.products');
    }
    public function getRequiredData()
    {
        $categoryData = DB::table('categories')
            ->where('status', 'Active')
            ->get();
        $sizeData = DB::table('sizes')
            ->where('status', 'Active')
            ->get();
        $productsAllData = DB::table('products')->get();

        return response()->json(['categoryData' => $categoryData, 'sizeData' => $sizeData, 'products' => $productsAllData]);
    }

    public function products_edit(string $product_id)
    {
        try {
            $productFind = DB::table('products')
                ->where('Product_id', $product_id)
                ->first();
            if ($productFind) {
                $categoryFind = DB::table('categories')->get();
                $sizesFind = DB::table('sizes')->get();
                return response()->json(['status' => 'success', 'product' => $productFind, 'category' => $categoryFind, 'size' => $sizesFind]);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Product not found']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getmessage()]);
        }
    }

    public function products_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_product_id' => 'required',
            'edit_product_name' => 'required',
            'edit_product_price' => 'required',
            'edit_product_category' => 'required',
            'edit_product_for' => 'required',
            'edit_product_size' => 'required',
            'edit_product_image' => 'mimes:jpg,png,avif,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'validation', 'error' => $validator->messages()]);
        }
        try {
            if ($request->has('edit_product_image')) {
                $file = 'images/products/' . $request->edit_product_image;
                $fileOriginalName = $request->file('edit_product_image')->getClientOriginalName();
                if (File::exists($file)) {
                    File::delete($file);
                }

                $update = DB::table('products')
                    ->where('Product_id', $request->edit_product_id)
                    ->update(['Product_name' => $request->edit_product_name, 'Product_price' => $request->edit_product_price, 'Product_category' => $request->edit_product_category, 'Product_for' => $request->edit_product_for, 'Product_size' => $request->edit_product_size, 'Product_image' => $fileOriginalName]);
                if ($update) {
                    $request->edit_product_image->move('images/products/', $fileOriginalName);

                    return response()->json(['status' => 'success', 'message' => 'updated successfully']);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'error in updating']);
                }
            } else {
                $update = DB::table('products')
                    ->where('Product_id', $request->edit_product_id)
                    ->update(['Product_name' => $request->edit_product_name, 'Product_price' => $request->edit_product_price, 'Product_category' => $request->edit_product_category, 'Product_for' => $request->edit_product_for, 'Product_size' => $request->edit_product_size]);
                return $update ? response()->json(['status' => 'success', 'message' => 'record updated successfully']) : response()->json(['status' => 'failed', 'message' => 'error in updating the record']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    public function products_add()
    {

        $product_sizes = DB::table('sizes')
            ->select('size_name')
            ->where('status', 'Active')
            ->get();

        $product_category = DB::table('categories')
            ->where('status', 'Active')
            ->get();

        return view('pages.product_add', compact('product_sizes', 'product_category'));
    }

    public function product_store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'product_name' => 'required',
                'product_price' => 'required|min:3|max:9',
                'product_category' => 'required',
                'product_for' => 'required',
                'product_size' => 'required',
                'product_image' => 'required|mimes:jpg,png,jpeg,avif',
            ],
            [],
        );
        if ($validator->fails()) {
            return response()->json(['status' => 'validation_error', 'message' => $validator->messages()]);
        }

        try {
            $filePath = 'images/products/' . $request->product_image;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $fileOriginalName = $request->file('product_image')->getClientOriginalName();

            $productAdd = DB::table('products')->insertOrIgnore([
                'Product_name' => $request->product_name,
                'Product_price' => $request->product_price,
                'Product_category' => $request->product_category,
                'Product_for' => $request->product_for,
                'Product_size' => $request->product_size,
                'Product_image' => $fileOriginalName,
                'created_at' => now(),
                'updated_at' => now(),
                'Product_status' => 'Active',
            ]);

            if ($productAdd) {
                $request->product_image->move('images/products', $fileOriginalName);
                return response()->json(['status' => 'success', 'message' => 'Product Added successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error in Inserting the product']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    public function products_purchase()
    {


        return view('pages.purchased_products');
    }

    public function products_deactivate(string $product_id)
    {
        $productIfExists = DB::table('products')
            ->where('Product_id', $product_id)
            ->where('Product_status', 'Active')
            ->first();
        if ($productIfExists) {
            $productDeactivateQuery = DB::table('products')
                ->where('Product_id', $product_id)
                ->where('Product_status', 'Active')
                ->update(['Product_status' => 'Inactive']);
            return $productDeactivateQuery ? response()->json(['status' => 'success', 'message' => 'Product status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating the status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'product not found']);
        }
    }

    public function products_activate(string $product_id)
    {
        $productIfExists = DB::table('products')
            ->where('Product_id', $product_id)
            ->where('Product_status', 'Inactive')
            ->first();
        if ($productIfExists) {
            $productDeactivateQuery = DB::table('products')
                ->where('Product_id', $product_id)
                ->where('Product_status', 'Inactive')
                ->update(['Product_status' => 'Active']);
            return $productDeactivateQuery ? response()->json(['status' => 'success', 'message' => 'Product status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating the status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'product not found']);
        }
    }

    public function products_delete(string $product_id)
    {
        try {
            $productIfExists = DB::table('products')
                ->where('Product_id', $product_id)
                ->first();
            if ($productIfExists) {
                $deleteQuery = DB::table('products')
                    ->where('Product_id', $product_id)
                    ->delete();

                return $deleteQuery ? response()->json(['status' => 'success', 'message' => 'Prodcut deleted successfully']) : response()->json(['status' => 'failed', 'Error in deleting the product']);
            } else {
                return response()->json(['status' => 'success', 'message' => 'Product not founded']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    public function product_reactivate(string $product_id)
    {
        $productIfExists = DB::table('products')
            ->where('Product_id', $product_id)
            ->where('Product_status', 'Deleted')
            ->first();
        if ($productIfExists) {
            $productDeactivateQuery = DB::table('products')
                ->where('Product_id', $product_id)
                ->where('Product_status', 'Deleted')
                ->update(['Product_status' => 'Active']);
            $productDeactivateQuery ? session()->flash('Success', 'Product status updated successfully') : session()->flash('Error', 'Error in updating Product Status');
        } else {
            session()->flash('Error', "Product id $product_id not found");
        }
        return redirect()->route('products.available');
    }

    public function category_create()
    {

        $category_data = DB::table('categories')->paginate(3);
        return view('pages.category_available', compact('category_data'));
    }

    public function category_add()
    {


        return view('pages.category_add');
    }

    public function category_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'validation-error', 'message' => $validator->messages()]);
        }

        try {
            $insertCategory = DB::table('categories')->insertOrIgnore([
                'category_name' => $request->category_name,
                'status' => 'Active',
            ]);

            return $insertCategory ? response()->json(['status' => 'success', 'message' => 'category inserted successfully']) : response()->json(['status' => 'error', 'message' => 'Error in inserting the category']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function category_edit($id)
    {
        $data = DB::table('categories')->find($id);

        if ($data) {
            return response()->json(['status' => 'success', 'category' => $data]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Category not found']);
        }
    }

    public function category_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories,category_name',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'validation-failed', 'error' => $validator->messages()]);
        }

        try {
            $update = DB::table('categories')->where('id', $request->id)->update(['category_name' => $request->category_name]);

            return $update ? response()->json(['status' => 'success', 'message' => 'category updated successfully']) : response()->json(['status' => 'failed', 'message' => 'error in updating the category']);
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    public function getAllCustomer()
    {
        $customers = DB::table('customer_registration')->get();
        return response()->json(['data' => $customers]);
    }
    public function deactivateCustomer($id)
    {
        $deactive = DB::table('customer_registration')
            ->where('id', $id)
            ->where('customer_status', 'Active')
            ->first();
        if ($deactive) {
            $deleteQueryExec = DB::table('customer_registration')
                ->where('id', $id)
                ->where('customer_status', 'Active')
                ->update(['customer_status' => 'Inactive']);
            return $deleteQueryExec ? response()->json(['status' => 'success', 'message' => 'status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'error in updating status']);
        } else {
            return response()->json(['status' => 'error', 'messege' => 'Error in updating Status']);
        }
    }

    public function activateCustomer($id)
    {
        $active = DB::table('customer_registration')
            ->where('id', $id)
            ->where('customer_status', 'Inactive')
            ->first();
        if ($active) {
            $deleteQueryExec = DB::table('customer_registration')
                ->where('id', $id)
                ->where('customer_status', 'Inactive')
                ->update(['customer_status' => 'Active']);
            return $deleteQueryExec ? response()->json(['status' => 'success', 'message' => 'status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'error in updating status']);
        } else {
            return response()->json(['status' => 'error', 'messege' => 'Error in updating Status']);
        }
    }

    public function deleteCustomer($id)
    {
        $find = DB::table('customer_registration')
            ->where('id', $id)
            ->first();
        if ($find) {
            $update = DB::table('customer_registration')
                ->where('id', $id)
                ->update(['customer_status' => 'Deleted']);
            return $update ? response()->json(['status' => 'success', 'message' => 'customer deleted successfully']) : response()->json(['status' => 'failed', 'message' => 'error in deleting customer']);
        } else {
            return response()->json(['status' => 404, 'message' => 'id not found']);
        }
    }
    public function reactivateCustomer($id)
    {
        $find = DB::table('customer_registration')
            ->where('id', $id)
            ->where('customer_status', 'Deleted')
            ->first();
        if ($find) {
            $reactivate = DB::table('customer_registration')
                ->where('id', $id)
                ->where('customer_status', 'Deleted')
                ->update(['customer_status' => 'Active']);
            return $reactivate ? response()->json(['status' => 'success', 'message' => 'Customer Reactivated Successfully']) : response()->json(['status' => 'error', 'message' => 'Error in Reactivating the customer']);
        } else {
            return response()->json(['status' => 404, 'message' => 'id not found']);
        }
    }

    public function customer_create()
    {


        return view('pages.customer_details');
    }

    public function customer_add()
    {


        return view('pages.customer_add');
    }

    // Insert the customer if there is any profile picture or not
    public function customer_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_email' => 'required|email|unique:customer_registration,customer_email',
            'customer_mobile' => 'required|digits:10',
            'customer_password' => 'required|min:8|max:16',
            'customer_gender' => 'required',
            'customer_profile' => 'mimes:jpg,png,jpeg,avif',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'validation', 'error' => $validator->messages()]);
        }

        if ($request->customer_profile) {
            $fileOriginalName = $request->file('customer_profile')->getClientOriginalName();

            $filePath = 'images/profiles/' . $request->customer_profile;

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $storeCustomer = DB::table('customer_registration')->insertOrIgnore([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_mobile' => $request->customer_mobile,
                'customer_password' => $request->customer_password,
                'customer_gender' => $request->customer_gender,
                'customer_profile' => $fileOriginalName,
                'customer_status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($storeCustomer) {
                $request->customer_profile->move('images/profiles', $fileOriginalName);
                return response()->json(['status' => 'success', 'message' => 'Customer Added Successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error in Customer Inserting']);
            }
        } else {
            $storeCustomer = DB::table('customer_registration')->insertOrIgnore([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_mobile' => $request->customer_mobile,
                'customer_password' => $request->customer_password,
                'customer_gender' => $request->customer_gender,
                'customer_status' => 'Active',
                'customer_profile' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($storeCustomer) {
                return response()->json(['status' => 'success', 'message' => 'Customer Added Successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Error in Customer Inserting']);
            }
        }
    }

    public function customer_edit($id)
    {
        $findCustomerById = DB::table('customer_registration')->find($id);
        return $findCustomerById ? response()->json(['status' => 'success', 'customers' => $findCustomerById]) : response()->json(['status' => 404, 'message' => 'Id not found']);
    }

    public function customer_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_mobile' => 'required|digits:10',
            'customer_password' => 'required|min:8|max:16',
            'customer_gender' => 'required',
            'customer_profile' => 'mimes:jpg,png,avif,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'validation_failed', 'errors' => $validator->messages()]);
        }

        if ($request->has('customer_profile')) {
            $filePath = 'images/profiles/' . $request->customer_profile;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $fileOriginalName = $request->file('customer_profile')->getClientOriginalName();

            $update_query = DB::table('customer_registration')
                ->where('id', $request->id)
                ->update(['customer_name' => $request->customer_name, 'customer_mobile' => $request->customer_mobile, 'customer_password' => $request->customer_password, 'customer_gender' => $request->customer_gender, 'customer_profile' => $fileOriginalName]);
            if ($update_query) {
                $request->customer_profile->move('images/profiles/', $fileOriginalName);
                return response()->json(['status' => 'success', 'message' => 'record updated successfully']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'error in record updating']);
            }
        } else {
            $update_query = DB::table('customer_registration')
                ->where('id', $request->id)
                ->update(['customer_name' => $request->customer_name, 'customer_mobile' => $request->customer_mobile, 'customer_password' => $request->customer_password, 'customer_gender' => $request->customer_gender]);

            return $update_query ? response()->json(['status' => 'success', 'message' => 'record updated successfully']) : response()->json(['status' => 'failed', 'message' => 'error in updating record']);
        }
    }
    public function admin_edit()
    {
        $admin_data = DB::table('admin')->get();
        return view('pages.admin_edit', compact('admin_data'));
    }

    public function admin_update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email',
        ]);
        if ($request->has('profile')) {
            # code...
            $path = 'images/admin/' . $request->input('admin_profile');
            $fileOriginalName = $request->file('profile')->getClientOriginalName();

            if (File::exists($path)) {
                File::delete($path);
            }
            $updateQuery = DB::table('admin')
                ->where('admin_email', '=', $request->input('admin_email'))
                ->update(['admin_name' => $request->input('admin_name'), 'admin_profile' => $fileOriginalName]);
            if ($updateQuery) {
                $request->profile->move(public_path('images/admin/'), $fileOriginalName);
                session()->flash('Success', 'Profile Updated Successfully');
            }
        } else {
            $updateQuery = DB::table('admin')
                ->where('admin_email', '=', $request->input('admin_email'))
                ->update(['admin_name' => $request->input('admin_name')]);

            $updateQuery ? session()->flash('Success', 'Profile updated successfully') : session()->flash('Error', 'Error in updating the profile');
        }
        return redirect()->route('admin.edit');
    }

    public function change_password()
    {


        return view('pages.change_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8|max:16',

            'new_password_confirmation' => 'required',
        ]);
        if ($request->new_password == $request->old_password) {
            session()->flash('Error', 'The new Password cannot be old password');
            return redirect()->route('admin.change.password');
        } else {
            $updateQueryForPassword = DB::table('admin')
                ->where('admin_password', $request->old_password)
                ->update(['admin_password' => $request->new_password]);
            $updateQueryForPassword ? session()->flash('Success', 'Password Updated Successfully') : session()->flash('Error', 'Error in Updating the password');
            return redirect()->route('admin.change.password');
        }
    }

    public function rate()
    {
        return view('pages.rating');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'Validation', 'errors' => $validator->messages()]);
        }
        $admin_details = DB::table('admin')
            ->where('admin_email', $request->email)
            ->where('admin_password', $request->password)
            ->first();
        if ($admin_details) {
            session()->put('admin_email', $request->email);
            session()->put('admin_password', $request->password);
            return response()->json(['status' => 'success', 'message' => 'Login Successfully']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Invalid Credentials']);
        }
    }

    public function coupen_available()
    {


        return view('pages.coupen', compact(''));
    }

    public function coupen_add()
    {


        return view('pages.coupen_add');
    }

    public function coupen_used()
    {


        return view('pages.coupen_store');
    }

    public function coupen_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:coupens,coupen_name',
            'discount' => 'required',
            'quantity' => 'required',
            'expire' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 120, 'data' => $validator->messages()]);
        }

        $prefixCoupen = 'MERLIN-';
        $coupenAdd = DB::table('coupens')->insertOrIgnore([
            'coupen_name' => $prefixCoupen . $request->name,
            'discount' => $request->discount,
            'Quantity' => $request->quantity,
            'expire_date' => $request->expire,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $coupenAdd ? response()->json(['status' => 200, 'message' => 'coupen added successfully']) : response()->json(['status' => 404, 'message' => 'error in inserting coupen']);
    }

    public function coupen_load()
    {
        $coupen = DB::table('coupens')->get();
        return response()->json(['data' => $coupen]);
    }
    public function coupen_edit()
    {


        return view('pages.coupen_edit');
    }
    public function deactivate_coupen($Id)
    {
        $coupen = DB::table('coupens')
            ->where('id', $Id)
            ->where('status', 'Active')
            ->first();
        if ($coupen) {
            $coupenDeactivateQuery = DB::table('coupens')
                ->where('id', $Id)
                ->where('status', 'Active')
                ->update(['status' => 'Inactive']);
            return $coupenDeactivateQuery ? response()->json(['status' => 'success', 'message' => 'Product status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating the status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'product not found']);
        }
    }

    // FIXME :
    public function activate_coupen($id)
    {
        $coupen = DB::table('coupens')
            ->where('id', $id)
            ->where('status', 'Inactive')
            ->first();
        if ($coupen) {
            $coupenDeactivateQuery = DB::table('coupens')
                ->where('id', $id)
                ->where('status', 'Inactive')
                ->update(['status' => 'Active']);
            return $coupenDeactivateQuery ? response()->json(['status' => 'success', 'message' => 'Product status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating the status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'product not found']);
        }
    }
    public function getSelectedCoupen($id)
    {
        $coupens = DB::table('coupens')->find($id);

        return response()->json(['coupens' => $coupens]);
    }
    public function deleteCoupen($id)
    {
        $delete = DB::table('coupens')->delete($id);
        return $delete ? response()->json(['status' => 200]) : response()->json(['status' => 400]);
    }

    public function coupen_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required',
            'discount' => 'required',
            'expire' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 402, 'errors' => $validator->messages()]);
        }
        $query = DB::table('coupens')
            ->where('id', $request->id)
            ->update(['coupen_name' => $request->name, 'Quantity' => $request->quantity, 'discount' => $request->discount, 'expire_date' => $request->expire]);

        return $query ? response()->json(['status' => 102, 'message' => 'coupen updated successfully']) : response()->json(['status' => 404, 'message' => 'Error in updating Coupen']);
    }

    public function coupen_use()
    {


        return view('pages.coupen_used');
    }


    public function user_register_validate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'pass' => 'required|confirmed',
            'pass_confirmation' => 'required',
            'gender' => 'required',
            'profile' => 'required|mimes:png,jpg,jpeg',
        ]);
    }

    public function admin_logout()
    {
        session()->forget('admin_email');
        session()->forget('admin_password');
        return redirect()->route('admin.dashboard');
    }

    public function sizes_available()
    {


        $sizeData = DB::table('sizes')
            ->orderBy('size_name')
            ->paginate(3);

        return view('pages.sizes');
    }


    public function sizes_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size_name' => 'required|unique:sizes,size_name',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'validation', 'errors' => $validator->messages()]);
        }
        try {
            $insertSizes = DB::table('sizes')->insertOrIgnore([
                'size_name' => $request->size_name,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return $insertSizes ? response()->json(['status' => 'success', 'message' => 'Size Added successfully']) : response()->json(['status' => 'failed', 'message' => 'error in inserting the size']);
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    public function deactviate_sizes(string $id)
    {
        $find = DB::table('sizes')->where('id', $id)->where('status', 'Active')->first();
        if ($find) {
            $update = DB::table('sizes')->where('id', $id)->where('status', 'Active')->update(['status' => 'Inactive']);
            return $update ? response()->json(['status' => 'success', 'message' => 'status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'error in updating the status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'id not found']);
        }
    }

    public function activate_sizes(string $id)
    {
        $find = DB::table('sizes')->where('id', $id)->where('status', 'Inactive')->first();
        if ($find) {
            $update = DB::table('sizes')->where('id', $id)->where('status', 'Inactive')->update(['status' => 'Active']);
            return $update ? response()->json(['status' => 'success', 'message' => 'status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'error in updating the status']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'id not found']);
        }
    }

    public function delete_sizes(string $id)
    {
        $find = DB::table('sizes')->where('id', $id)->first();
        if ($find) {
            $update = DB::table('sizes')->where('id', $id)->delete();
            return $update ? response()->json(['status' => 'success', 'message' => 'Size Deleted Successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in deleting the size']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'id not found']);
        }
    }

    public function edit_size($id)
    {
        $find = DB::table('sizes')->find($id);
        return response()->json(['sizes' => $find]);
    }
    public function size_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size_name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'validation', 'error' => $validator->messages()]);
        }

        try {
            $update = DB::table('sizes')->where('id', $request->id)->update(['size_name' => $request->size_name]);

            return $update ? response()->json(['status' => 'success', 'message' => 'size updated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating the size']);
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }
    public function getSizes()
    {
        $data = DB::table('sizes')->get();
        return response()->json(['size' => $data]);
    }
    public function reactivate_sizes(string $size_name)
    {
        $check = DB::table('sizes')
            ->where('size_name', $size_name)
            ->first();

        if ($check) {
            $checkIfSizeStatusIsDeleted = DB::table('sizes')
                ->where('size_name', $size_name)
                ->where('status', 'Deleted')
                ->update(['status' => 'Active']);

            $checkIfSizeStatusIsDeleted ? session()->flash('Success', 'Status updated successfully') : session()->flash('Error', 'Error in updating status');
        } else {
            session()->flash('Error', "Size $size_name not found");
        }
        return redirect()->route('sizes.available');
    }

    public function activate_category(string $id)
    {
        $checkIfCategoryExists = DB::table('categories')
            ->where('id', $id)
            ->first();
        if ($checkIfCategoryExists) {
            $checkIfCategoryStatusUpdated = DB::table('categories')
                ->where('id', $id)
                ->where('status', 'Deactive')
                ->update(['status' => 'Active']);
            return $checkIfCategoryStatusUpdated ? response()->json(['status' => 'success', 'message' => 'Category Status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating the status of category']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Category not found']);
        }
    }

    public function deactivate_category(string $id)
    {
        $checkIfCategoryExists = DB::table('categories')
            ->where('id', $id)
            ->first();
        if ($checkIfCategoryExists) {
            $checkIfCategoryStatusUpdated = DB::table('categories')
                ->where('id', $id)
                ->where('status', 'Active')
                ->update(['status' => 'Deactive']);
            return $checkIfCategoryStatusUpdated ? response()->json(['status' => 'success', 'message' => 'Category Status updated successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in updating the status of category']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Category not found']);
        }
    }

    public function delete_category(string $id)
    {
        $checkIfCategoryExists = DB::table('categories')
            ->where('id', $id)
            ->first();
        if ($checkIfCategoryExists) {
            $checkIfCategoryStatusDeleted = DB::table('categories')
                ->where('id', $id)
                ->delete();
            return $checkIfCategoryStatusDeleted ? response()->json(['status' => 'success', 'message' => 'Category Deleted successfully']) : response()->json(['status' => 'failed', 'message' => 'Error in Deleting the category']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Category Not Found']);
        }
    }

    public function reactivate_category(string $category_name)
    {
        $checkIfCategoryExists = DB::table('categories')
            ->where('category_name', $category_name)
            ->first();
        if ($checkIfCategoryExists) {
            $checkIfCategoryStatusReactivated = DB::table('categories')
                ->where('category_name', $category_name)
                ->where('status', 'Deleted')
                ->update(['status' => 'Active']);
            $checkIfCategoryStatusReactivated ? session()->flash('Success', 'Category status updated successfully') : session()->flash('Error', 'Error in updating category status');
        } else {
            session()->flash('Error', "Category $category_name not found");
        }
        return redirect()->route('category.available');
    }

    public function getData()
    {
        $categoryData = DB::table('categories')->get();

        return response()->json(['data' => $categoryData]);
    }
}
