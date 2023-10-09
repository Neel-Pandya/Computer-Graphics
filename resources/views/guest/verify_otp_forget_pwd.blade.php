@extends('guest.master')

@section('titles')
Forget Password
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


<div class="container mt-4 col-6">

    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!! </strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="login form">
        <header class="logo-name" style="font-family: cursive">Verify Otp</header>

        <form method="POST" enctype="multipart/form-data"
            action="{{ URL::to('/') }}/guest_user/verify_otp_forget_password_action">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                    <input type="text" placeholder="Enter OTP" name="otp" required>
                    <span class="text-danger">
                        @error('customer_name')
                        {{ $message }}
                        @enderror
                    </span>
                </div>

                <input type="submit" class="button" value="verify OIP">
            </div>
        </form>

    </div>
</div>
@endsection