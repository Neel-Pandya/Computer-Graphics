@extends('pages.master')

@section('title')

Admin Edit profile

@endsection

@section('content')
<h4 class="text-primary text-center">Edit Profile</h4>
    <img src="{{ URL::to('/') }}/images/faces/face1.jpg" />

        <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data ">
    @csrf
    <div class="row">
        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Admin name</label>
            <input type="text" name="admin_name" id="" class="form-control" placeholder="Enter Admin name" value="{{ old('admin_name') }}">
            <span class="text-danger">
                @error('admin_name')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Admin email</label>
            <input type="email" name="admin_email" id="" class="form-control" placeholder="Enter Admin email" value="{{ old('admin_email') }}">

            <span class="text-danger">
                @error('admin_email')
                {{ $message }}
                @enderror
            </span>
        </div>


      
        <div class="mt-4 col-lg-6 col-md-6 col-sm-12">
            <label for="" class="form-label">Choose Profile</label>
            <input type="file" name="admin_profile" id="" class="form-control">
            <span class="text-danger">
                @error('admin_profile')
                {{ $message }}
                @enderror
            </span>
        </div>


      

        <div class="mt-4 col-lg-12 col-md-12 col-sm-12 text-center">
            <input type="submit" value="Submit" class="btn btn-primary text-center">
        </div>





    </div>


</form>

        </div>
      </div>
    </div>
  </div>


@endsection