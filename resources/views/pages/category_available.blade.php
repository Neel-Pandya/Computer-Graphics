@extends('pages.master')
@section('title')
Products
@endsection
@section('content')

<div class="table-responsive">
    <table class="table  table-striped  table-bordered">
        <caption class="mt-4"><a href="{{ route('category.add') }}"><button class="btn btn-info">Add Category</button></a></caption>
        <thead class="table-dark text-center ">
            <th>Id</th>
            <th>Category name</th>
            <th>Category For</th>
            <th>Category Status</th>
            <th colspan="2">Actions</th>
            
        </thead>
        <tbody class="text-center">
            <tr>
                <td>1</td>
                <td>Hoodie</td>
                <td>Male</td>
                <td><a href=""><button class="btn btn-danger">Deactivate</button></a></td>
                <td><a href="{{ route('category.edit') }}"><button class="btn btn-info">Edit</button></a></td>
                <td><a href=""><button class="btn btn-danger">Delete</button></a></td>
               
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection