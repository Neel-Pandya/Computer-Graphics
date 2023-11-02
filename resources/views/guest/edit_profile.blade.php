@extends('guest.master')


@section('titles')
Edit Profile
@endsection

@section('content')
<div class="container">

    <div class="index form d-flex justify-content-center align-items-center vh-100">

        <div class="row">
            <div class="col-12 text-center">
                <h3>Edit Profile</h3>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 mt-4">
                <img src="{{ URL::to('/') }}/images/profiles/{{ $userData->customer_profile }}" alt="">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <form method="POST" enctype="multipart/form-data" action="{{ route('edit.profile.validate') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-md-6 mt-4">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="customer_name" id="" value="{{ $userData->customer_name }}"
                                class="form-control">

                            <span class="text-danger">
                                @error('customer_name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 mt-4">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="customer_email" id="" value="{{ $userData->customer_email }}"
                                class="form-control" readonly>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 mt-4">
                            <label for="" class="form-label">Mobile</label>
                            <input type="number" name="customer_mobile" id="" value="{{ $userData->customer_mobile }}"
                                class="form-control">
                            <span class="text-danger">
                                @error('customer_mobile')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 mt-4">
                            <label for="" class="form-label">Choose File</label>
                            <input type="file" name="customer_profile" id="" class="form-control">

                            @error('customer_profile')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center mt-5">
                            <input type="submit" value="Submit" class="btn btn-success col-12">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection