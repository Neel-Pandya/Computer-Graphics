@extends('pages.master')

@section('title')

Admin Edit profile

@endsection

@section('content')
<h4 class="text-primary text-center">Change Password</h4>
@foreach ($admin_data as $admin )
    
@endforeach

<form action="{{ route('admin.password') }}" method="POST"
>
    @csrf
    <div class="row">
        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">old password</label>
            <input type="text" name="old_password" id="" class="form-control" placeholder="Enter old password"
                value="{{ $admin->admin_password }}" readonly>
            <span class="text-danger">
                @error('old_password')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">new Password</label>
            <input type="text" name="new_password" id="" class="form-control" placeholder="Enter new Password"
                value="{{ old('new_password') }}">

            <span class="text-danger">
                @error('new_password')
                {{ $message }}
                @enderror
            </span>
        </div>




        <div class="mt-4 col-lg-12 col-md-12 col-sm-12">
            <label for="" class="form-label">Confirm password</label>
            <input type="text" name="new_password_confirmation" id="" class="form-control"
                placeholder="Confirm password" value="{{ old('new_password_confirmation') }}">
            <span class="text-danger">
                @error('new_password_confirmation')
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