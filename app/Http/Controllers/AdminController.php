<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public $admin_data;

    public function setdata()
    {
        return $this->admin_data = DB::table('admin')->get();
    }

    //
    public function create()
    {
        $admin_data = $this->setdata();
        return view('index', compact('admin_data'));
    }

    public function products(Request $request)
    {
        $admin_data = $this->setdata();
        if ($request->input('search')) {
            $getProductsRecord = DB::table('products')
                ->orWhere('Product_category', 'like', '%' . $request->search . '%')
                ->orWhere('Product_for', $request->search)
                ->orWhere('Product_price', 'like', '%' . $request->search . '%')
                ->orWhere('Product_size', $request->search)
                ->orWhere('Product_status', 'like', '%' . $request->search . '%')
                ->paginate(4);
        } else {
            $getProductsRecord = DB::table('products')->paginate(4);
        }

        return view('pages.products', compact('admin_data', 'getProductsRecord'));
    }

    public function products_edit()
    {
        $admin_data = $this->setdata();

        return view('pages.edit_products', compact('admin_data'));
    }

    public function products_update(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_category' => 'required',
            'product_for' => 'required',
            'product_size' => 'required|alpha',
            'product_image' => 'mimes:jpg,png',
        ]);
    }
    public function products_add()
    {
        $admin_data = $this->setdata();
        $product_sizes = DB::table('sizes')
            ->select('size_name')
            ->where('status', 'Active')
            ->get();

        $product_category = DB::table('categories')
            ->where('status', 'Active')
            ->get();

        return view('pages.product_add', compact('admin_data', 'product_sizes', 'product_category'));
    }

    public function product_store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_category' => 'required',
            'product_for' => 'required',
            'product_size' => 'required',
            'product_image' => 'required|mimes:jpg,png,jpeg,avif',
        ]);

        $productImageOriginalName = $request->file('product_image')->getClientOriginalName();

        $insertProduct = DB::table('products')->insertOrIgnore([
            'Product_name' => $request->product_name,
            'Product_price' => $request->product_price,
            'Product_category' => $request->product_category,
            'Product_for' => $request->product_for,
            'Product_size' => $request->product_size,
            'Product_image' => $productImageOriginalName,
            'Product_status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($insertProduct) {
            $request->product_image->move(public_path('images/products/'), $productImageOriginalName);
            session()->flash('Success', 'Product added successfully');
        } else {
            session()->flash('Error', 'Error in inserting the product');
        }

        return redirect()->route('products.available');
    }

    public function products_purchase()
    {
        $admin_data = $this->setdata();

        return view('pages.purchased_products', compact('admin_data'));
    }

    public function category_create()
    {
        $admin_data = $this->setdata();
        $category_data = DB::table('categories')->paginate(3);
        return view('pages.category_available', compact('admin_data', 'category_data'));
    }
    public function category_add()
    {
        $admin_data = $this->setdata();

        return view('pages.category_add', compact('admin_data'));
    }
    public function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $storeCategory = DB::table('categories')->insert([
            'category_name' => $request->category_name,
            'status' => 'Active',
        ]);
        $storeCategory ? session()->flash('Success', 'Category added successfully') : session()->flash('Error', 'Error in adding category');

        return redirect()->route('category.available');
    }

    public function category_edit()
    {
        $admin_data = $this->setdata();

        return view('pages.category_edit', compact('admin_data'));
    }
    public function category_update(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
    }
    public function customer_create()
    {
        $admin_data = $this->setdata();

        return view('pages.customer_details', compact('admin_data'));
    }
    public function customer_add()
    {
        $admin_data = $this->setdata();

        return view('pages.customer_add', compact('admin_data'));
    }

    public function customer_store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_gender' => 'required',
            'customer_number' => 'required|numeric|digits:10',
            'customer_profile' => 'required|mimes:jpg,png',
        ]);
    }
    public function customer_edit()
    {
        $admin_data = $this->setdata();

        return view('pages.customer_edit', compact('admin_data'));
    }
    public function admin_edit()
    {
        $admin_data = $this->setdata();

        return view('pages.admin_edit', compact('admin_data'));
    }

    public function admin_update(Request $request)
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
        $admin_data = $this->setdata();

        return view('pages.change_password', compact('admin_data'));
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
    public function shoes()
    {
        $admin_data = $this->setdata();

        return view('pages.shoes', compact('admin_data'));
    }
    public function jeans()
    {
        $admin_data = $this->setdata();

        return view('pages.jeans', compact('admin_data'));
    }
    public function hoodie()
    {
        $admin_data = $this->setdata();

        return view('pages.hoodie', compact('admin_data'));
    }
    public function shirt()
    {
        $admin_data = $this->setdata();

        return view('pages.shirt', compact('admin_data'));
    }

    public function products_female()
    {
        $admin_data = $this->setdata();

        return view('pages.product_female', compact('admin_data'));
    }

    public function products_male()
    {
        $admin_data = $this->setdata();

        return view('pages.products_male', compact('admin_data'));
    }
    public function rate()
    {
        $admin_data = $this->setdata();

        return view('pages.rating', compact('admin_data'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin_details = DB::table('admin')
            ->where('admin_email', $request->email)
            ->where('admin_password', $request->password)
            ->first();
        if ($admin_details) {
            session()->put('admin_email', $request->email);
            session()->put('admin_password', $request->password);
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function coupen_available()
    {
        $admin_data = $this->setdata();

        return view('pages.coupen', compact('admin_data'));
    }
    public function coupen_add()
    {
        $admin_data = $this->setdata();

        return view('pages.coupen_add', compact('admin_data'));
    }
    public function coupen_used()
    {
        $admin_data = $this->setdata();

        return view('pages.coupen_store', compact('admin_data'));
    }
    public function coupen_store(Request $request)
    {
        $request->validate([
            'coupen_name' => 'required',
            'coupen_price' => 'required|numeric',
            'coupen_expire_date' => 'required',
            'coupen_discount' => 'required',
        ]);
    }
    public function coupen_edit()
    {
        $admin_data = $this->setdata();

        return view('pages.coupen_edit', compact('admin_data'));
    }

    public function coupen_update(Request $request)
    {
        $request->validate([
            'coupen_price' => 'required|numeric',
            'coupen_expire_date' => 'required',
            'coupen_discount' => 'required',
        ]);
    }

    public function coupen_use()
    {
        $admin_data = $this->setdata();

        return view('pages.coupen_used', compact('admin_data'));
    }

    public function user_login()
    {
        $admin_data = $this->setdata();

        return view('users.user_login', compact('admin_data'));
    }
    public function user_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
    public function user_register()
    {
        $admin_data = $this->setdata();

        return view('users.user_register', compact('admin_data'));
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
        $admin_data = $this->setdata();

        $sizeData = DB::table('sizes')
            ->orderBy('size_name')
            ->paginate(3);

        return view('pages.sizes', compact('admin_data', 'sizeData'));
    }

    public function sizes_add()
    {
        $admin_data = $this->setData();
        return view('pages.addSizes', compact('admin_data'));
    }

    public function sizes_store(Request $request)
    {
        $request->validate(
            [
                'product_size' => 'required|regex:/^[A-Z]{1,4}$/',
            ],
            [
                'product_size.required' => 'This field is required',
                'product_size.regex' => 'Product size must be of less than or equal to 4 character and only capital letters allowed',
            ],
        );

        $sizesAddData = DB::table('sizes')->insert([
            'size_name' => $request->product_size,
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $sizesAddData ? session()->flash('Success', 'Size added successfully') : session()->flash('Error', 'Error in inserting the Size');
        return redirect()->route('sizes.available');
    }

    public function deactviate_sizes(string $size_name)
    {
        $check = DB::table('sizes')
            ->where('size_name', $size_name)
            ->first();
        if ($check) {
            $checkIfSizeStatusIsActive = DB::table('sizes')
                ->where('size_name', $size_name)
                ->where('status', 'Active')
                ->update(['status' => 'Deactive']);
            $checkIfSizeStatusIsActive ? session()->flash('Success', 'Status updated successfully') : session()->flash('Error', 'Error in updating status');
        } else {
            session()->flash('Error', "Size name $size_name not found");
        }
        return redirect()->route('sizes.available');
    }

    public function activate_sizes(string $size_name)
    {
        $check = DB::table('sizes')
            ->where('size_name', $size_name)
            ->first();
        if ($check) {
            $checkIfSizeStatusIsActive = DB::table('sizes')
                ->where('size_name', $size_name)
                ->where('status', 'Deactive')
                ->update(['status' => 'Active']);
            $checkIfSizeStatusIsActive ? session()->flash('Success', 'Status updated successfully') : session()->flash('Error', 'Error in updating status');
        } else {
            session()->flash('Error', "Size name $size_name not found");
        }
        return redirect()->route('sizes.available');
    }
    public function delete_sizes(string $size_name)
    {
        $check = DB::table('sizes')
            ->where('size_name', $size_name)
            ->first();
        if ($check) {
            $setSizeStatusDeleted = DB::table('sizes')
                ->where('size_name', $size_name)
                ->update(['status' => 'Deleted']);

            $setSizeStatusDeleted ? session()->flash('Success', 'status updated successfully') : session()->flash('Error', 'Error in updating the status');
        } else {
            session()->flash('Error', "Size $size_name not found");
        }

        return redirect()->route('sizes.available');
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

    public function activate_category(string $category_name)
    {
        $checkIfCategoryExists = DB::table('categories')
            ->where('category_name', $category_name)
            ->first();
        if ($checkIfCategoryExists) {
            $checkIfCategoryStatusUpdated = DB::table('categories')
                ->where('category_name', $category_name)
                ->where('status', 'Deactive')
                ->update(['status' => 'Active']);
            $checkIfCategoryStatusUpdated ? session()->flash('Success', 'Category status updated successfully') : session()->flash('Error', 'Error in updating category status');
        } else {
            session()->flash('Error', "Category $category_name not found");
        }
        return redirect()->route('category.available');
    }

    public function deactivate_category(string $category_name)
    {
        $checkIfCategoryExists = DB::table('categories')
            ->where('category_name', $category_name)
            ->first();
        if ($checkIfCategoryExists) {
            $checkIfCategoryStatusUpdated = DB::table('categories')
                ->where('category_name', $category_name)
                ->where('status', 'Active')
                ->update(['status' => 'Deactive']);
            $checkIfCategoryStatusUpdated ? session()->flash('Success', 'Category status updated successfully') : session()->flash('Error', 'Error in updating category status');
        } else {
            session()->flash('Error', "Category $category_name not found");
        }
        return redirect()->route('category.available');
    }

    public function delete_category(string $category_name)
    {
        $checkIfCategoryExists = DB::table('categories')
            ->where('category_name', $category_name)
            ->first();
        if ($checkIfCategoryExists) {
            $checkIfCategoryStatusDeleted = DB::table('categories')
                ->where('category_name', $category_name)
                ->update(['status' => 'Deleted']);
            $checkIfCategoryStatusDeleted ? session()->flash('Success', 'Category status updated successfully') : session()->flash('Error', 'Error in updating category status');
        } else {
            session()->flash('Error', "Category $category_name not found");
        }
        return redirect()->route('category.available');
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
}
