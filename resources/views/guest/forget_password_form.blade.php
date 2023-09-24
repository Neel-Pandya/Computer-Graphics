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
            <header class="logo-name" style="font-family: cursive">Forget Password</header>

            <form method="POST" enctype="multipart/form-data" action="">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                        <input type="email" placeholder="Enter your email" name="em" required>
                        <span class="text-danger">
                            @error('customer_name')
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
