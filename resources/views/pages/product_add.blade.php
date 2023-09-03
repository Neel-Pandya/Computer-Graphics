@extends('pages.master')

@section('title')
    Add Products
@endsection

@section('content')
    <h4 class="text-primary text-center">Add Product</h4>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
                <label for="" class="form-label">Enter Product name</label>
                <input type="text" name="product_name" id="" class="form-control" placeholder="Enter Product name"
                    value="{{ old('product_name') }}">
                <span class="text-danger">
                    @error('product_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
                <label for="" class="form-label">Enter Product Price</label>
                <input type="number" name="product_price" id="" class="form-control"
                    placeholder="Enter Product Price" value="{{ old('product_price') }}">

                <span class="text-danger">
                    @error('product_price')
                        {{ $message }}
                    @enderror
                </span>
            </div>


            <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
                <label for="" class="form-label">Product Category</label>
                <select name="product_category" id="" class="form-select form-control">
                    <option value="">Choose Category</option>

                    @foreach ($product_category as $category)
                        <option value="{{ $category->category_name }}" @if (old('product_category') == $category->category_name) selected @endif>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('product_category')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            

            <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
                <label for="" class="form-label">Choose Product for</label>
                <select name="product_for" id="" class="form-select form-control">
                    <option value="">Choose Gender</option>
                    @php
                        $product_for_gender = ['Male', 'Female'];
                    @endphp
                    @foreach ($product_for_gender as $gender)
                        <option value="{{ $gender }}" @if (old('product_for') == $gender) selected @endif>
                            {{ $gender }}</option>
                    @endforeach
                </select>
                
                <span class="text-danger">
                    @error('product_for')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
                <label for="" class="form-label">Choose Product Size</label>
                <select name="product_size" class="form-control form-select" id="">

                    <option value="">Choose product size</option>

                    @foreach ($product_sizes as $product)
                        <option value="{{ $product->size_name }}" @if (old('product_size') == $product->size_name) selected @endif>
                            {{ $product->size_name }}
                        </option>
                    @endforeach

                </select>
                <span class="text-danger">
                    @error('product_size')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
                <label for="" class="form-label">Choose Product Image</label>
                <input type="file" name="product_image" id="" class="form-control">
                <span class="text-danger">
                    @error('product_image')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="mt-4 col-lg-12 col-md-12 col-sm-12 text-center">
                <input type="submit" value="Submit" class="btn btn-primary text-center">
            </div>


        </div>


    </form>
@endsection
