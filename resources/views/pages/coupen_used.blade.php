@extends('pages.master')


@section('title')

Used Coupen

@endsection

@section('content')

<table class="table  table-striped  table-bordered">
    <caption class="mt-4"><a href="{{ route('products.add') }}"><button class="btn btn-info">Add product</button></a></caption>
    <thead class="table-dark text-center ">
        <th>Cust Id</th>
        <th>Customer name</th>
        <th>Customer email</th>
        
        <th>Coupen id</th>
        <th>Coupen name</th>
        <th>Coupen price</th>
        
        <th>Coupen Discount</th>


    </thead>
    <tbody class="text-center">
        <tr>
            <td>1</td>
            <td>Neel pandya</td>
            <td>neel@gmail.com</td>
            <td>3</td>
            <td>Special Discount</td>
            <td>300 Rs</td>
            <td>50%</td>
          
        </tr>
    </tbody>
</table>

@endsection