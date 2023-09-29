@extends('guest.master')


@section('titles')
    Change Password
@endsection

@section('content')
    <div class="container">
        
        <div class="index form d-flex justify-content-center align-items-center vh-100">
           
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Change Password</h3>
                </div>

                
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('change.password.validate') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-md-6 mt-4">
                                <label for="" class="form-label">Enter Old Password</label>
                                <input type="password" name="old_pass" id=""
                                    value="" class="form-control">

                                <span class="text-danger">
                                    @error('old_pass')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6 mt-4">
                                <label for="" class="form-label">Enter New Password</label>
                                <input type="password" name="new_pass" id=""
                                    value="" class="form-control" >
                                    
                                <span class="text-danger">
                                    @error('new_pass')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 mt-4">
                                <label for="" class="form-label">Retype New Password</label>
                                <input type="password" name="new_pass_confirmation" id=""
                                    value="" class="form-control">
                                <span class="text-danger">
                                    @error('new_pass_confirmation')
                                        {{ $message }}
                                    @enderror
                                </span>
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
