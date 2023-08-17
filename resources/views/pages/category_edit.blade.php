@extends('pages.master')

@section('title')

Edit Category

@endsection

@section('content')
<h4 class="text-primary text-center">Edit Category</h4>

<form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="mt-4 col-lg-12 col-md-12 col-sm-12">
            <label for="" class="form-label">Enter Category name</label>
            <input type="text" name="category_name" id="" class="form-control" placeholder="Enter Product name" value="product_name" >
            <span class="text-danger">
                 @error('product_name')
                     {{ $message }}
                 @enderror
            </span>
        </div>
        <div class="mt-4 col-lg-12 col-md-12 col-sm-12 text-center">
            <input type="submit" value="Update" class="btn btn-primary ">
        </div>
   
    </div>


</form>

@endsection