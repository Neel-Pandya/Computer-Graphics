@extends('pages.master')

@section('title')
    Edit Products
@endsection

@section('content')
    <h4 class="text-primary text-center">Edit Product</h4>

    <form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Image Column -->
            <div class="mt-4 col-lg-4 col-md-4 col-sm-12">
                <img src="{{ asset('images/products/' . $products_data->Product_image) }}" alt="Product Image" class="img-fluid">
            </div>

            <!-- Form Column -->
            <div class="mt-4 col-lg-8 col-md-8 col-sm-12">
                <label for="" class="form-label">Product name</label>
                <input type="text" name="product_name" id="" class="form-control"
                    placeholder="Enter Product name" value="{{ $products_data->Product_name }}" readonly>
                <span class="text-danger">
                    @error('product_name')
                        {{ $message }}
                    @enderror
                </span>

                <label for="" class="form-label mt-4">Enter Product Price</label>
                <input type="number" name="product_price" id="" class="form-control"
                    placeholder="Enter Product Price" value="{{ $products_data->Product_price }}">
                <span class="text-danger">
                    @error('product_price')
                        {{ $message }}
                    @enderror
                </span>

                <label for="" class="form-label mt-4">Product Category</label>
                <select name="product_category" id="" class="form-select form-control">
                    <option value="{{ $products_data->Product_category }}">{{ $products_data->Product_category }}</option>

                    @forelse ($product_category_data as $data)
                        <option value="{{ $data->category_name }}">{{ $data->category_name }}</option>
                    @empty
                    @endforelse
                </select>
                <span class="text-danger">
                    @error('product_category')
                        {{ $message }}
                    @enderror
                </span>

                <label for="" class="form-label mt-4">Choose Product for</label>
                <select name="product_for" id="" class="form-select form-control">
                    <option value="{{ $products_data->Product_for }}">{{ $products_data->Product_for }}</option>
                    <option value="{{ $genders }}">{{ $genders }}</option>
                </select>
                <span class="text-danger">
                    @error('product_for')
                        {{ $message }}
                    @enderror
                </span>

                <label for="" class="form-label mt-4">Choose Product Size</label>
                <select name="product_size" class="form-control form-select" id="">
                    <option value="{{ $products_data->Product_size }}">{{ $products_data->Product_size }}</option>
                    @foreach($product_sizes as $products)
                        <option value="{{ $products->size_name }}">{{ $products->size_name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('product_size')
                        {{ $message }}
                    @enderror
                </span>

                <label for="" class="form-label mt-4">Choose Product Image</label>
                <input type="file" name="product_image" id="" class="form-control">
                <span class="text-danger">
                    @error('product_image')
                        {{ $message }}
                    @enderror
                </span>

                <div class="mt-3 text-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
@endsection
