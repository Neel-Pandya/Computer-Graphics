@extends('pages.master')

@section('title')

Edit Products

@endsection

@section('content')
<h4 class="text-primary text-center">Edit Product</h4>

<form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Enter Product name</label>
            <input type="text" name="product_name" id="" class="form-control" placeholder="Enter Product name" value="product_name" value="{{ old('product_name') }}" readonly>
            <span class="text-danger">
                 @error('product_name')
                     {{ $message }}
                 @enderror
            </span>
        </div>

        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Enter Product Price</label>
            <input type="number" name="product_price" id="" class="form-control" placeholder="Enter Product Price" value="{{ old('product_price') }}">
            
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
                @php
                $product_category = array('Shoes', 'Jeans', 'Shirt', 'Hoodie');
                @endphp
                @foreach ($product_category as $category )
                <option value="{{ $category }}" @if (old('product_category') == $category)
                        selected
                @endif>{{ $category }}</option>
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
                $product_for_gender = array('Male', 'Female');
                @endphp
                @foreach ($product_for_gender as $gender )
                <option value="{{ $gender }}"  @if (old('product_for') == $gender)
                selected
        @endif>{{ $gender }}</option>
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
                @php
                    $product_size = array('L', 'M', 'X', 'XXL', 'XXXL');
                @endphp

                <option value="">Choose product size</option>

                @foreach ($product_size as $product )
                    <option value="{{ $product }}" @if (old('product_size') == $product)
                        selected
                    @endif>{{ $product }}</option>
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