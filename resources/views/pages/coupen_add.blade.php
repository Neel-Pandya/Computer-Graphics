@extends('pages.master')

@section('title')
Coupens
@endsection


@section('content')
<div class="table-responsive">
    <table class="table  table-striped  table-bordered">
        <caption class="mt-4">
            <!-- Button trigger modal -->
        </caption>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">Add Coupens</h4>

                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form id="formSubmit" method="POST">

                                <div class="row">
                                    <div class="col-12">
                                        <ul class="error-message alert-danger">

                                        </ul>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label">Coupen Name</label>
                                        <input type="text" name="coupen" id="coupen" class="form-control">
                                        <span class="text-danger nm"></span>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label for="" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control">
                                        <span class="text-danger quantity"></span>
                                    </div>
                                    @php
                                    $arr = [];
                                    for ($i = 1; $i <= 100; $i++) { if ($i % 3==0) { $arr[$i]=$i . '%' ; } } @endphp
                                        <div class="col-12 mt-4">
                                        <label for="" class="form-label">Discount</label>
                                        <select name="discount" id="discount" class="form-control form-select">
                                            <option value="">Select the discount</option>
                                            @foreach ($arr as $a)
                                            <option value="{{ $a }}">{{ $a }}</option>
                                            @endforeach
                                        </select>

                                        <span class="text-danger discount-msg"></span>
                                </div>
                                <div class="col-12 mt-4">
                                    <label for="" class="form-label">Expire Date</label>
                                    <input type="date" name="expire" id="expire" class="form-control">
                                    <span class="text-danger date-msg"></span>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary button-submit">Save changes</button>
                </div>
            </div>
        </div>
        </form>
</div>
</caption>
<thead class="table-dark text-center ">
    <th>Id</th>
    <th>Coupen name</th>
    <th>Quantity</th>

    <th>Coupen Expire Date</th>
    <th>status</th>
    <th>Coupen Discount</th>

    <th colspan="2">Actions</th>

</thead>
<tbody class="text-center">

</tbody>

</table>
</div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Coupen
</button>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Edit Coupens</h4>

            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="editForm" method="POST">

                        <div class="row">
                            <div class="col-12">
                                <ul class="edit-error-message alert-danger">

                                </ul>
                            </div>

                            <input type="hidden" name="id" class="ID">
                            <div class="col-12">
                                <label for="" class="form-label">Coupen Name</label>
                                <input type="text" name="coupen" class="form-control coupens">
                                <span class="text-danger nm"></span>
                            </div>
                            <div class="col-12 mt-4">
                                <label for="" class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control qty">

                            </div>
                            @php
                            $arr = [];
                            for ($i = 1; $i <= 100; $i++) { if ($i % 3==0) { $arr[$i]=$i . '%' ; } } @endphp <div
                                class="col-12 mt-4">
                                <label for="" class="form-label">Discount</label>
                                <select name="discount" id="discount" class="form-control form-select discount">
                                    <option value="">Select the discount</option>
                                    @foreach ($arr as $a)
                                    <option value="{{ $a }}">{{ $a }}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger discount-msg"></span>
                        </div>
                        <div class="col-12 mt-4">
                            <label for="" class="form-label">Expire Date</label>
                            <input type="date" name="expire" id="expire" class="form-control expire">
                            <span class="text-danger date-msg"></span>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_modal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary button-submit">Save changes</button>
        </div>
    </div>
</div>
@endsection


{{-- Backend Code --}}
@section('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(document).ready(function () {

        // Fetching All data
        function loadAllCoupens() {

            $.ajax({
                method: "GET",
                url: "load_coupen",
                dataType: "json",
                success: function (response) {
                    let buttonText
                    let buttonClass
                    let buttonId
                    $("tbody").html("")
                    console.log(buttonText)

                    $.each(response.data, function (indexInArray, valueOfElement) {
                        if (valueOfElement.status == 'Active') {
                            buttonText = 'Deactivate'
                            buttonClass = 'btn btn-danger button-deactive'
                        } else if (valueOfElement.status == 'Inactive') {
                            buttonText = 'Active'
                            buttonClass = 'btn btn-success button-active'

                        }
                        $("tbody").append(
                            `<tr> 
                            <td> ${valueOfElement.id} </td>
                            <td> ${valueOfElement.coupen_name}</td>
                            <td> ${valueOfElement.Quantity}</td>
                            <td> ${valueOfElement.expire_date} </td>
                            <td> ${valueOfElement.discount} </td>
                            <td> <button class='${buttonClass}' value='${valueOfElement.id}' id='${buttonId}'> ${buttonText} </button> </td>
                            

                            <td> <button class='btn btn-info button-edit' value='${valueOfElement.id}'>Edit</button> </td>
                            <td> <button class ='btn btn-danger button-delete' value='${valueOfElement.id}'> Delete </button></td>    
                        </tr>`
                        )
                    });
                }
            });
        }
        loadAllCoupens()




        // Inserting the data
        $('#formSubmit').on('submit', function (e) {
            e.preventDefault()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: "store",
                data: {

                    "name": $("#coupen").val(),
                    "discount": $("#discount").val(),
                    "quantity": $("#quantity").val(),
                    "expire": $("#expire").val(),
                },

                success: function (response) {
                    if (response.status == 120) {

                        $(".error-message").html("")
                        $.each(response.data, function (indexInArray, valueOfElement) {

                            $(".error-message").append(
                                `<li style='list-style: none;'> ${valueOfElement} </li>`
                            )
                        });

                    } else {
                        $(".error-message").html("")
                    }
                    if (response.status == 200) {
                        $("#exampleModal").modal('hide')
                        $("#exampleModal").find('input').val("")
                        $("#exampleModal").find('select').val("")


                        sweetAlert("success", response.message)
                        loadAllCoupens()
                    } else if (response.status == 404) {
                        $("#exampleModal").modal('hide')
                        $("#exampleModal").find('input').val("")
                        $("#exampleModal").find('option').val("")

                        sweetAlert('error', response.message)

                    }
                },
                error: function (response) {
                    console.log(response)
                }
            });
        });


        $(document).on('click', '.button-activate', function () {

        });
        // Edit
        $(document).on('click', '.button-edit', function () {
            let $id = $(this).val()
            $("#editModal").modal('show')


            $.ajax({
                type: "GET",
                url: `edit-coupens/${$id}`,
                dataType: "json",
                success: function (response) {
                    $(".ID").val(response.coupens.id)
                    $(".coupens").val(response.coupens.coupen_name)
                    $(".qty").val(response.coupens.Quantity)
                    $(".discount").val(response.coupens.discount)
                    $(".expire").val(response.coupens.expire_date)
                    $(".button-submit").html("Update")



                }
            });

        });

        // update The data

        $(document).on('submit', '#editForm', function (event) {
            event.preventDefault();
            let value = $(this).val()
            let data = {
                "id": $(".ID").val(),
                "name": $(".coupens").val(),
                "quantity": $(".qty").val(),
                "discount": $(".discount").val(),
                "expire": $(".expire").val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "update",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status == 402) {
                        $(".edit-error-message").html("")
                        $.each(response.errors, function (indexInArray, valueOfElement) {
                            $(".edit-error-message").append(
                                `<li style='list-style: none;'> ${valueOfElement} </li>`
                            );
                        });
                    }
                    if (response.status == 102) {
                        $("#editModal").modal('hide')
                        $(".edit-error-message").html("")
                        $("#editModal").find('input').val("")
                        sweetAlert("success", response.message)

                        loadAllCoupens();
                    } else if (response.status == 404) {
                        $("#editModal").modal('hide')
                        $(".edit-error-message").html("")
                        $("#editModal").find('input').val("")
                        sweetAlert("error", response.message)
                    }
                }
            });
        });


        // Delete
        $(document).on('click', '.button-delete', function () {
            let deleteValue = $(this).val()
            $.ajax({
                type: "GET",
                url: `delete-coupen/${deleteValue}`,
                dataType: "json",
                success: function (response) {
                    if (response.status == 200) {
                        sweetAlert("success", "Coupen Deleted Successfully");
                        loadAllCoupens();
                    }
                }
            });
        });

        // Deactive the data
        $(document).on('click', '.button-deactive', function () {
            let deactiveValue = $(this).val()
            $.ajax({
                type: "GET",
                url: `deactivate/${deactiveValue}`,

                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        loadAllCoupens()
                    }
                    else {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });
        // activate the data

        $(document).on('click', '.button-active', function () {
            let activeButtonValue = $(this).val()

            $.ajax({
                type: "GET",
                url: `activate/${activeButtonValue}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        loadAllCoupens()
                    }
                    else {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });

    });
</script>
@endsection