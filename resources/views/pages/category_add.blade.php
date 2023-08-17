@extends('pages.master')

@section('title')

Category Add

@endsection

@section('content')
<h4 class="text-primary text-center">Add Category</h4>

<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data ">
    @csrf
    <div class="row">
        <div class="mt-4 col-lg-12 col-md-12 col-sm-12">
            <label for="" class="form-label">Enter Category name</label>
            <input type="text" name="category_name" id="" class="form-control" placeholder="Enter Category name" >
            <span class="text-danger">
                 @error('category_name')
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