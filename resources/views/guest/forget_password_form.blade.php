@extends('guest.master')

@section('titles')
    Register
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


    <div class="container mt-4 col-6">
        <input type="checkbox" id="check">
        <div class="login form">
            <header class="logo-name" style="font-family: cursive">Register</header>

            <form method="POST" enctype="multipart/form-data" action="{{ route('guest.confirm.register') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                        <input type="text" placeholder="Enter your name" name="customer_name" value="{{ old('customer_name') }}">
                        <span class="text-danger">
                            @error('customer_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">

                        <input type="email" placeholder="Enter Your email" name="customer_email" value="{{ old('customer_email') }}">
                        <span class="text-danger">
                            @error('customer_email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">

                        <input type="password" placeholder="Enter Your Password" name="customer_password" value="{{ old('customer_password') }}">
                        <span class="text-danger">
                            @error('customer_password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">

                        <input type="password" placeholder="Confirm password" name="customer_password_confirmation" value="{{ old('customer_password_confirmation') }}">
                        <span class="text-danger">
                            @error('customer_password_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">

                        <select name="customer_gender" id="" class="form-select form-control">
                            <option value="">Select gender</option>
                            @php
                                $arr = ['Male', 'Female'];
                            @endphp
                            @foreach ($arr as $item)
                                <option value="{{ $item }}" {{ old('customer_gender') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('customer_gender')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">

                        <input type="number" placeholder="Enter Your Number" name="customer_number" value="{{ old('customer_number') }}">
                        <span class="text-danger">
                            @error('customer_number')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-mt-4">
                        <input type="file" name="pic" id="">
                        <span class="text-danger">
                            @error('pic')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <input type="submit" class="button" value="Register">
                </div>
            </form>
            <div class="signup">
                <span class="signup">Already have an account?
                    <a href="{{ route('guest.login') }}">Login</a>
                </span>
            </div>
        </div>
    </div>
@endsection
