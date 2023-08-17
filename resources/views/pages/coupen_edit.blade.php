@extends('pages.master')

@section('title')

Edit Coupen

@endsection

@section('content')


@php
    $array = array(); 
    for ($i=1; $i <= 100 ; $i++) { 
        # code...
        if($i % 5 == 0){
        $array[$i] = $i . "%"; 
        }

    }
@endphp
<h4 class="text-primary text-center">Coupen Edit</h4>
<form action="{{ route('coupen.update') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
            <label for="" class="form-label">Enter Coupen Name</label>
            <input type="text" name="coupen_name" id="" class="form-control" placeholder="Enter coupen name" value="coupen" readonly>
          
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
            <label for="" class="form-label">Enter Coupen Price</label>
            <input type="number" name="coupen_price" id="" class="form-control" placeholder="Enter coupen Price" value="{{ old('coupen_price') }}">
            <span class="text-danger">
                @error('coupen_price')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
            <label for="" class="form-label">Enter coupen expire date</label>
            <input type="date" name="coupen_expire_date" id="" class="form-control" value="{{ old('coupen_expire_date') }}">
            <span class="text-danger">
                @error('coupen_expire_date')
                    {{ $message }}
                @enderror
            </span>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
            <label for="" class="form-label">Enter Coupen Discount</label>
            <select name="coupen_discount" id="" class="form-select form-control">
                <option value="">Select Discount</option>
                @foreach ($array as $r )
                    <option value="{{ $r }}" @if (old('coupen_discount') == $r)
                        selected
                    @endif>{{ $r }}</option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('coupen_discount')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 mt-4 ">
            <center>
                <input type="submit" value="Submit" class="btn btn-primary">
            </center>
        </div>
    </div>
</form>
@endsection