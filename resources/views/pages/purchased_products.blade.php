@extends('pages.master')
@section('title')
Purchased Products
@endsection
@section('content')

<div class="table-responsive">
    <table class="table  table-striped  table-bordered">

        <thead class="table-dark text-center ">
            <th>id</th>
            <th>Email</th>
            <th>address</th>
            <th>Product id</th>
            <th>Product_name</th>
            <th>Product_price</th>
            <th>Product_size</th>
            <th>Product_for</th>
            <th>Product_category</th>
            <th>Product_image</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>OverAll Total</th>
            <th>used Coupen</th>


        </thead>
        <tbody class="text-center">

        </tbody>
    </table>
</div>
</div>
@endsection

@section('scripts')

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    $(function () {
        const loadAllPurchasedProducts = () => {
            $.ajax({
                type: "GET",
                url: "get-all-products",
                success: function (response) {
                    console.log(response)

                    if (response.status == 'success') {
                        $("tbody").html('')
                        $.each(response.data, function (indexInArray, valueOfElement) {
                            const { id, email, address, Product_id, Product_name, Product_for, Product_size, Product_category, Product_price, Quantity, coupen, FullTotal, image, total } = valueOfElement

                            $("tbody").append(
                                `
                                    <tr>
                                        <td>${id}</td>
                                        <td>${email}</td>
                                        <td>${address}</td>
                                        <td>${Product_id}</td>
                                        <td>${Product_name}</td>
                                        <td>${Product_price}</td>
                                        <td>${Product_size}</td>
                                        <td>${Product_for}</td>
                                        <td>${Product_category}</td>
                                        <td><img src="{{ URL::to('/') }}/images/products/${image}" style="width:50px;"</td>
                                        <td>${Quantity}</td>
                                        <td>${total}</td>
                                        <td>${FullTotal}</td>
                                        <td>${coupen}</td>
                                    </tr>
                                `

                            )
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        loadAllPurchasedProducts()
    });
</script>
@endsection