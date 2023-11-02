@extends('guest.master')

@section('titles')
Order History
@endsection

@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead class="text-center">
                <th>Sr no.</th>
                <th>Product id</th>
                <th>Product name</th>
                <th>Product price</th>
                <th>Product size</th>
                <th>Product for</th>
                <th>Product Category</th>
                <th>Quantity</th>
                <th>total</th>
                <th>Image</th>
                <th>Status</th>
                <th>Applied Coupens</th>
            </thead>

            <tbody>

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
        const loadAllUserPurchases = () => {
            $.ajax({
                type: "GET",
                url: "get-purchased-products",
                success: function (response) {
                    let className, classText

                    $("tbody").html("")
                    let count = 1;
                    $.each(response.products, function (indexInArray, valueOfElement) {
                        const { Product_id, Product_name, Product_size, Product_for, Product_price, Product_category, FullTotal, Quantity, coupen, image, status, total: itemsTotal } = valueOfElement
                        if (status == 'purchased') {
                            className = "btn btn-danger btn-refund"
                            classText = "Refund"
                        }
                        $("tbody").append(
                            `<tr class='text-center'>
                                 <td>${count++}</td>
                                 <td>${Product_id}</td>
                                 <td>${Product_name}</td>
                                 <td>${Product_price} Rs</td>
                                 <td>${Product_size}</td>
                                 <td>${Product_for}</td>
                                 <td>${Product_category}</td>
                                 <td>${Quantity}</td>
                                 <td>${itemsTotal} Rs</td>
                                 <td><img src="{{ URL::to('/') }}/images/products/${image}" style="width:100px; height: 50px; object-fit: contain;"></td>
                                 <td><button class="${className}"> ${classText} </button></td>
                                 <td>${coupen}</td>
                            </tr>`

                        )
                    });
                }
            });
        }

        loadAllUserPurchases()
    });
</script>
@endsection