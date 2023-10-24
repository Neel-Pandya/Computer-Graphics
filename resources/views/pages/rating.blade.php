@extends('pages.master')

@section('title')

Rating

@endsection

@section('title')
Products
@endsection
@section('content')

<div class="table-responsive">
    <table class="table  table-striped  table-bordered">

        <thead class="table-dark text-center ">
            <th>Cust id</th>
            <th>Customer name</th>
            <th>Customer email</th>
            <th>Customer number</th>
            <th>Rating</th>
            <th>Product id</th>
            <th>Product name</th>
            <th>Product Category</th>
            <th>product image</th>
            <th>Product For Genders</th>

        </thead>
        <tbody class="text-center">
            <tr>
                <td>1</td>
                <td>Neel</td>
                <td>neel@gmail.com</td>
                <td>8866163085</td>
                <td>4.5/5</td>
                <td>1</td>
                <td>Men's stylish shoes</td>
                <td>shoes</td>

                <td><img src="https://images.pexels.com/photos/19090/pexels-photo.jpg?cs=srgb&dl=pexels-web-donut-19090.jpg&fm=jpg"
                        alt="" srcset="" style="height: 100%; width:100%; " class="img"></td>
                <td>Male</td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection