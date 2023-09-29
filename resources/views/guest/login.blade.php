@extends('guest.master')


@section('titles')

Edit Profile

@endsection

@section('content')
<div class="container">
            <div class="index form d-flex justify-content-center align-items-center vh-100" >
                <div class="alertMessages">
                    @if (session()->has('Success'))
                        <div class="alert alert-success  d-flex align-items-center" role="alert">
                            <strong>
                                {{ session('Success') }}
                            </strong>

                            <script>
                                setTimeout(() => {
                                    $('.alert').alert('close');
                                }, 5000);
                            </script>
                            @php session()->forget('Success');  @endphp
                        </div>
                    @elseif(session()->has('Error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            {{ session('Error') }}
                            <script>
                                setTimeout(() => {
                                    $('.alert').alert('close');
                                }, 5000);
                            </script>
                            @php session()->forget('Error'); @endphp


                        </div>
                    @endif
                </div>

                    <form action="{{ route('guest.login.validate') }}" method="POST" class="" >
                        <div class="col-lg-12 col-md-12s col-sm-12 text-center" >
                        <h3>Login</h3>  
                        </div>
                        <div class="row">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                        <label for="" class="form-label">Enter Email</label>
                        <input type="text" placeholder="Enter your email" name="customer_email" class="form-control"
                            value="{{ old('customer_email') }}">
                        <span class="text-danger">
                            @error('customer_email')
                                {{ $message }}
                            @enderror
                        </span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                        <label for="" class="form-label">Enter password</label>
                        <input type="password" placeholder="Enter your password" name="customer_password" class="form-control "
                            value="{{ old('customer_password') }}">
                        <span class="text-danger">
                            @error('customer_password')
                                {{ $message }}
                            @enderror
                        </span>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">

                        <input type="submit" class="btn btn-success mt-3 col-12" value="Login">
                        </div>
                    </form>
                    <div class="signup mt-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end ">
                        <span class="signup">Don't have an account?
                            <a href="{{ route('guest.register') }}">Register</a>
                        </span>
                    </div>


                    <div class="forgetpasword col-12 d-flex justify-content-end mt-2">
                        <span class="forget">Forget Password
                            <a href="{{ route('forget.password') }}">forget</a>
                        </span>
                    </div>



                </div>
                
                </div>
            </div>
        </div>

@endsection
