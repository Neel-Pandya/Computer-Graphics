@extends('guest.master')

@section('titles')
Order History
@endsection

@section('content')
<div class="container mt-4">
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

<div class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Refund Product</h5>

            </div>
            <div class="modal-body">

                <form id="myForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <img alt="" id="refundImage">
                        </div>
                        <div class="col-12 mt-4">
                            <label for="">What is the problem with this product ? </label>
                            <input type="text" name="" id="refund-text" class="form-control mt-2">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary button-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>

        </div>
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
                        const { Product_id, Product_name, Product_size, Product_for, Product_price, Product_category, FullTotal, Quantity, coupen, image, status, total: itemsTotal, id } = valueOfElement
                        if (status == 'purchased') {
                            className = "btn btn-danger btn-refund"
                            classText = "Refund"
                        } else if (status == 'refund request sent...') {
                            className = 'btn btn-secondary disabled bg-transparent text-dark '
                            classText = valueOfElement.status
                        } else if (status == 'refunded') {
                            className = "btn btn-success disabled bg-transparent text-success border border-none"
                            classText = valueOfElement.status
                        } else if (status == 'declined') {
                            className = "btn btn-danger disabled bg-transparent text-danger border border-none"
                            classText = "refund declined";
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
                             <td><button class="${className}" style="font-size: 1rem;" value="${id}"> ${classText} </button></td>
                             <td>${coupen}</td>

                             <input type="hidden" class="hidden-id" value="${id}"> 
                        </tr>`
                        );
                    });
                }
            });
        }

        loadAllUserPurchases();

        // Attach the submit event handler outside of the button click event handler
        $(document).on("submit", '#myForm', function (e) {
            e.preventDefault();
            let id = $(this).data('refund-id'); // Capture the id from the form's data attribute
            let formData = new FormData(this);
            formData.append('id', id);
            formData.append('refund', $("#refund-text").val());
            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/guest_user/refund-product",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message);
                        $(".modal").modal('hide');
                        loadAllUserPurchases();
                        $("#refund-text").val("")
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        // Attach the button click event handler using event delegation
        $(document).on('click', '.btn-refund', function () {
            let id = $(this).val();
            $(".modal").modal('show');
            $.ajax({
                type: "GET",
                url: `{{ URL::to('/') }}/guest_user/get-refund/${id}`,
                success: function (response) {
                    document.querySelector('#refundImage').setAttribute('src', `{{ URL::to('/') }}/images/products/${response.product.image}`);
                    $('#myForm').data('refund-id', id); // Store the id in a data attribute of the form
                }
            });
        });

        document.querySelector('.button-close').addEventListener('click', function () {
            $(".modal").modal('hide');
        });
    });

</script>
@endsection