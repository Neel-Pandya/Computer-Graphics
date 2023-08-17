@extends('pages.master')
@section('title')
Purchased Products
@endsection
@section('content')

<div class="table-responsive">
    <table class="table  table-striped  table-bordered">
       
        <thead class="table-dark text-center ">
            <th>Customer id</th>
            <th>Customer name</th>
            <th>Customer Email</th>
            
            <th>Product name</th>
            <th>Product price</th>
            <th>Product category</th>
            <th>Gender</th>
            <th>Purchased status</th>
            <th>Product photo</th>



        </thead>
        <tbody class="text-center">
            <tr>
                <td>2</td>
                <td>Neel pandya</td>
                <td>neel@gmail.com</td>
            

                <td>Special Hoodie</td>
                <td>200 Rs</td>
                <td>Hoodie</td>
                <td>Male</td>
                <td>Returned</td>
                <td><img src="{{ URL::to('/') }}/images/products/pexels-gabriel-freytez-341523.jpg" alt="" srcset="">
                </td>
             
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection