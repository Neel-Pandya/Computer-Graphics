@extends('pages.master')

@section('title')
Admin Edit profile
@endsection

@section('content')
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
        @php session()->forget('Success'); @endphp
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

<h4 class="text-primary text-center">Edit Profile</h4>

@foreach ($admin_data as $admin)
@endforeach
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
        <img src="{{ URL::to('/') }}/images/admin/{{ $admin->admin_profile }}" class="img-fluid" width="100%" />
    </div>

    <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data"
        class="col-lg-8 col-md-6 col-sm-12">
        @csrf

        <label for="" class="form-label mt-4">Admin name</label>
        <input type="text" name="admin_name" id="" class="form-control" placeholder="Enter Admin name"
            value="{{ $admin->admin_name }}">
        <span class="text-danger">
            @error('admin_name')
            {{ $message }}
            @enderror
        </span>

        <label for="" class="form-label mt-4">Admin email</label>
        <input type="email" name="admin_email" id="" class="form-control" placeholder="Enter Admin email"
            value="{{ $admin->admin_email }}" readonly>

        <span class="text-danger">
            @error('admin_email')
            {{ $message }}
            @enderror
        </span>



        <label for="" class="form-label mt-4">Choose Profile</label>
        <input type="file" name="profile" id="" class="form-control">
        <span class="text-danger">
            @error('profile')
            {{ $message }}
            @enderror
        </span>





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