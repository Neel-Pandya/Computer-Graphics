@extends('guest.master')

@section('titles')
Forget Password
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


<div class="container mt-4 col-6">
    <div class="login form">
        <header class="logo-name" style="font-family: cursive">Change Password</header>

        <form method="POST" enctype="multipart/form-data" action="{{ URL::to('/') }}/guest_user/reset_pwd_action">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                    <input type="password" placeholder="Enter New Password" name="npwd" required>
                    <span class="text-danger">
                        @error('npwd')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                    <input type="password" placeholder="Retype new Password" name="npwd_confirmation" required>
                    <span class="text-danger">
                        @error('npwd_confirmation')
                        {{ $message }}
                        @enderror
                    </span>
                </div>


                <input type="submit" class="button" value="Reset Password">
            </div>
        </form>

    </div>
</div>
@endsection