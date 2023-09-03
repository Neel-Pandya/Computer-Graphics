@extends('pages.master')
@section('title')
Products
@endsection
@section('content')

<div class="table-responsive">
    <table class="table  table-striped  table-bordered">
        <caption class="mt-4"><a href="{{ route('products.add') }}"><button class="btn btn-info">Add product</button></a></caption>
        <thead class="table-dark text-center ">
            <th>Id</th>
            <th>Product name</th>
            <th>Product price</th>
            <th>Product category</th>
            <th>Gender</th>
            <th>Product photo</th>
            <th>Product Status</th>
            <th colspan="2">Actions</th>

        </thead>
        <tbody class="text-center">
            <tr>
                <td>1</td>
                <td>Special Hoodie</td>
                <td>200 Rs</td>
                <td>Hoodie</td>
                <td>Male</td>
                <td><img src="{{ URL::to('/') }}/images/products/pexels-gabriel-freytez-341523.jpg" alt=""  srcset="">
                </td>
                <td><button class="btn btn-danger">Deactivate</button></td>
                <td><a href="{{ route('products.edit') }}"><button class="btn btn-info">Edit</button></a></td>
                <td><button class="btn  btn-danger ">Delete</button></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection