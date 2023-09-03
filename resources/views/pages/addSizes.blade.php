@extends('pages.master')

@section('title')

Add Sizes

@endsection

@section('content')

    <h4 class="text-primary text-center">Add Product</h4>

<form action="{{ route('sizes.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <div class="mt-4 col-lg-12 col-md-12 col-sm-12">
            <label for="" class="form-label">Enter Product Size</label>
            <input type="text" name="product_size" id="" class="form-control" placeholder="Enter Product name"
                 value="{{ old('product_size') }}" >
            <span class="text-danger">
                @error('product_size')
                {{ $message }}
                @enderror
            </span>
        </div>

       <div class="col-md-12 col-sm-12 col-lg-12 text-center mt-5">
        <input type="submit" value="Submit" class="btn btn-primary">
       </div>
    </div>
</form>

@endsection
