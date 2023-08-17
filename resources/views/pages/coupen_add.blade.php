@extends('pages.master')

@section('title')

Coupens

@endsection

@section('content')
<table class="table  table-striped  table-bordered">
    <caption class="mt-4"><a href="{{ route('coupen.used') }}"><button class="btn btn-info">Add product</button></a>
    </caption>
    <thead class="table-dark text-center ">
        <th>Id</th>
        <th>Coupen name</th>
        <th>Coupen price</th>
        <th>Coupen Expire Date</th>
        <th>Coupen Status</th>
        <th>Coupen Discount</th>
        
        <th colspan="2">Actions</th>

    </thead>
    <tbody class="text-center">
        <tr>
            <td>1</td>
            <td>Special Offer Discount</td>
            <td>500 Rs</td>
            <td>18-6-22</td>
           
            <td><button class="btn btn-danger">Deactivate</button></td>
            <td>90% off on every product</td>
            <td><a href="{{ route('coupen.edit') }}"><button class="btn btn-info">Edit</button></a></td>
            <td><button class="btn  btn-danger ">Delete</button></td>
        </tr>
    </tbody>
</table>
@endsection