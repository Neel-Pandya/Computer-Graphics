@extends('pages.master')

@section('title')

Refund Request

@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-light bg-dark text-light table-hover table-striped">
        <thead class="text-center">
            <th>Order id</th>
            <th>user email</th>
            <th>Message for Product refund</th>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Product Price</th>
            <th>image</th>
            <th>Actions</th>
        </thead>
        <tbody class="text-center table bg-light text-dark"></tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    function loadAllRefundRequests() {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/') }}/admin/refunds/get-refund-requests",
            success: function (response) {
                $("tbody").html('')

                $.each(response.data, function (indexInArray, valueOfElement) {
                    $("tbody").append(
                        `<tr>
                            <td> ${valueOfElement.user_id}</td>
                            <td> ${valueOfElement.email}</td>
                            <td> ${valueOfElement.user_message}</td>
                            <td> ${valueOfElement.Product_name}</td>
                            <td> ${valueOfElement.Quantity}</td>
                            <td> ${valueOfElement.Product_price}</td>
                            <td> <img src="{{ URL::to('/') }}/images/products/${valueOfElement.image}" style="width:100px; height:80px; object-fit:contain;"> </td>    
                            <td><button class='btn btn-success btn-approve' value="${valueOfElement.user_id}">Approve Refund </button> </td>
                            <td><button class='btn btn-danger btn-decline' value="${valueOfElement.user_id}">Decline</button></td>
                        </tr>`

                    )
                });
            },
            error: function (err) {
                console.log(err)
            }
        });
    }

    loadAllRefundRequests()

    $(document).on('click', '.btn-approve', function (e) {
        let user_id = e.target.value;

        $.ajax({
            type: "GET",
            url: `{{ URL::to('/') }}/admin/refunds/approve/${user_id}`,
            success: function (response) {
                console.log(response)
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllRefundRequests()
                }
                else if (response.status == 'failed') {
                    sweetAlert('error', response.message)
                }
            },
            error: function (err) {
                console.log(err)
            }
        });

    });

    $(document).on('click', '.btn-decline', function (e) {
        let id = e.target.value;
        $.ajax({
            type: "GET",
            url: `{{ URL::to('/') }}/admin/refunds/decline/${id}`,
            success: function (response) {
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllRefundRequests()
                }
                else if (response.status == 'failed') {
                    sweetAlert('error', response.message)
                }
            }
        });
    });
</script>
@endsection