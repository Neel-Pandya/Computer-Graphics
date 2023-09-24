@extends('guest.master')



@section('titles')
    Contact
@endsection


@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


    <div class="container mt-4 col-6">
        <input type="checkbox" id="check">
        <div class="form">
            <header class="logo-name" style="font-family: cursive">Contact Us</header>

            <form method="POST" enctype="multipart/form-data" action="{{ route('guest.confirm.contact') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                        <input type="text" placeholder="Enter your name" name="customer_name" class="form-control" value="{{ old('customer_name') }}">
                        <span class="text-danger">
                            @error('customer_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">

                        <input type="email" placeholder="Enter Your email" name="customer_email" class="form-control" value="{{ old('customer_email') }}">
                        <span class="text-danger">
                            @error('customer_email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <textarea name="customer_message" id="" class="form-control mt-5" placeholder="Enter your message">{{ old('customer_message') }}</textarea>
                        <span class="text-danger">
                            @error('customer_message')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                        <input type="submit" value="Submit" class="btn btn-primary col-2">
                    </div>
                </div>
        </div>
    @endsection
