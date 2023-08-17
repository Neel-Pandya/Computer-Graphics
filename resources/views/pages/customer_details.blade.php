@extends('pages.master')
@section('title')
Customers Details
@endsection
@section('content')

<div class="table-responsive">
    <table class="table  table-striped  table-bordered">
        <caption class="mt-4"><a href="{{ route('customers.add') }}"><button class="btn btn-info">Add
                    product</button></a></caption>
        <thead class="table-dark text-center ">
            <th>Id</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Customer Gender</th>
            <th>Customer mobile</th>
            <th>Customer Profile</th>
            <th>Customer Status</th>
            <th colspan="2">Actions</th>

        </thead>
        <tbody class="text-center">
            <tr>
                <td>1</td>
                <td>Neel pandya</td>
                <td>neel@gmail.com</td>
                <td>Male</td>
                <td>8866163085</td>
                <td><img src="{{ URL::to('/') }}/images/faces/face1.jpg" alt="" srcset="">
                </td>
                <td><button class="btn btn-danger">Deactivate</button></td>
                <td><a href="{{ route('customer.edit') }}"><button class="btn btn-info">Edit</button></a></td>
                <td><button class="btn  btn-danger ">Delete</button></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection