@extends('pages.master')

@section('title')

Add Products

@endsection

@section('content')
<h4 class="text-primary text-center">Edit Customer</h4>

<form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data ">
    @csrf
    <div class="row">
        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Enter Customer name</label>
            <input type="text" name="customer_name" id="" class="form-control" placeholder="Enter Customer name" value="{{ old('customer_name') }}">
            <span class="text-danger">
                @error('customer_name')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Enter Customer Email</label>
            <input type="email" name="customer_email" id="" class="form-control" placeholder="Enter Customer email" value="{{ old('customer_email') }}">

            <span class="text-danger">
                @error('customer_email')
                {{ $message }}
                @enderror
            </span>
        </div>



        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Customer Gender</label>
            <select name="customer_gender" id="" class="form-select form-control">
                <option value="">Choose Gender</option>
                @php
                $customer_gender = array('Male', 'Female');
                @endphp
                @foreach ($customer_gender as $gender )
                <option value="{{ $gender }}" @if (old('customer_gender') == $gender)
                selected
        @endif>{{ $gender }}</option>
                
                @endforeach
            </select>
            <span class="text-danger">
                @error('customer_gender')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Enter Customer Mobile</label>
            <input type="tel" name="customer_number" id="" class="form-control" placeholder="Enter Product number" value="{{ @old('customer_number') }}">

            <span class="text-danger">
                @error('customer_number')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mt-4 col-lg-12 col-md-12 col-sm-12">
            <label for="" class="form-label">Choose Customer Image</label>
            <input type="file" name="customer_profile" id="" class="form-control">
            <span class="text-danger">
                @error('customer_profile')
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