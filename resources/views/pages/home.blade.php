@extends('pages.master')

@section('title')

Home

@endsection

@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table table-light table-striped table-hover table-bordered">
            <thead class="bg-dark text-light text-center">
                <th>Id</th>
                <th>Image</th>
                <th>Status</th>
                <th colspan="2">Actions</th>
            </thead>
            <tbody class="table">

            </tbody>
        </table>
    </div>

    <button class="btn btn-primary mt-4 button-add-image">Add new Image</button>
</div>
<!-- Add Modal -->
<div class="modal fade" id="addHomeImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5 " id="exampleModalLabel">Add Home Images</h3>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                --}}
            </div>
            <div class="modal-body">
                <form method="POST" id="addHomeImageForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <ul class="add-home-errors alert-danger"></ul>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                            <label for="" class="form-label">Image</label>
                            <input type="file" id="profile" class="form-control" required>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editHomePageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5 " id="exampleModalLabel">Add Home Images</h3>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                --}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 add-image">

                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <form method="POST" id="editHomePageImagesForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="" id="image-id">
                                <div class="col-12">
                                    <ul class="add-home-errors alert-danger"></ul>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" id="edit_profile" class="form-control">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-2 modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>


                    </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.button-add-image', function () {
            $("#addHomeImageModal").modal('show');
        });

        function loadHomeImage() {
            $.ajax({
                type: "GET",
                url: "show",
                success: function (response) {
                    $("tbody").html('')
                    $.each(response.data, function (indexInArray, valueOfElement) {
                        let status, buttonText, buttonClass

                        if (valueOfElement.status == 'Active') {
                            buttonClass = 'btn btn-danger button-deactivate'
                            buttonText = 'Deactivate'
                        }
                        else {
                            buttonClass = 'btn btn-success button-activate'
                            buttonText = 'Activate'
                        }
                        $("tbody").append(
                            `<tr class='text-center'>
                                <td>${valueOfElement.id}</td>
                                <td><img src='{{ URL::to('/') }}/images/products/${valueOfElement.image}' class='img-fluid' style='width:80px;'> </td>
                                <td><button class='${buttonClass}' value='${valueOfElement.id}'>${buttonText} </button></td>
                                <td> <button class='btn btn-primary button-edit' value='${valueOfElement.id}'> Edit</button></td>
                                <td><button class='btn btn-danger button-delete' value='${valueOfElement.id}'>Delete</button></td>
                            </tr>
                                `
                        )

                    });
                }
            });
        }
        loadHomeImage()

        $(document).on('submit', '#addHomeImageForm', function (event) {
            event.preventDefault();
            let formData = new FormData(this)

            formData.append('profile', $("#profile")[0].files[0]);
            $.ajax({
                type: "POST",
                url: "store",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // console.log(response)
                    if (response.status == 'validation') {
                        console.log(response.message)
                    }
                    else {

                    }
                    if (response.status == 'success') {
                        $("#addHomeImageModal").modal('hide')
                        sweetAlert('success', response.message)
                        loadHomeImage()
                        $("#addHomeImageModal").find('input').val('')

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

        $(document).on('click', '.button-activate', function () {
            let buttonVal = $(this).val()
            $.ajax({
                type: "GET",
                url: `activate/${buttonVal}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        loadHomeImage()
                    }
                    else if (response.status == 'failed') {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });

        $(document).on('click', '.button-deactivate', function () {
            console.log($(this).val())
            let buttonVal = $(this).val()
            $.ajax({
                type: "GET",
                url: `deactivate/${buttonVal}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        loadHomeImage()
                    }
                    else if (response.status == 'failed') {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });

        $(document).on('click', '.button-delete', function () {
            let buttonVal = $(this).val()
            $.ajax({
                type: "GET",
                url: `delete/${buttonVal}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        loadHomeImage()
                    }
                    else if (response.status == 'failed') {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });

        $(document).on('click', '.button-edit', function () {
            let buttonVal = $(this).val()
            $("#editHomePageModal").modal('show')

            $.ajax({
                type: "GET",
                url: `edit/${buttonVal}`,
                success: function (response) {
                    $('.add-image').html('')
                    $("#image-id").val(response.editData.id)
                    // console.log(response)
                    $(".add-image").append(
                        `
                            <img src='{{ URL::to('/') }}/images/products/${response.editData.image}' width='100%'> 
                        `
                    )

                    $(document).on('submit', '#editHomePageImagesForm', function (event) {
                        event.preventDefault()
                        let formdata = new FormData(this)
                        let selected_file = $("#edit_profile")[0].files[0]
                        formdata.append('id', $("#image-id").val());
                        if (selected_file) {
                            formdata.append('profile', $("#edit_profile")[0].files[0])
                        }
                        $.ajax({
                            type: "post",
                            url: "update",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.status == 'validation') {

                                }
                                else {

                                }
                                if (response.status == 'success') {
                                    $("#editHomePageModal").modal('hide')
                                    sweetAlert('success', response.message)
                                    loadHomeImage()

                                }
                                else if (response.status == 'failed') {
                                    $("#editHomePageModal").modal('hide')
                                    sweetAlert('error', response.message)

                                }
                            },
                            error: function (err) {
                                console.log(err)
                            }
                        });


                    });
                },
                error: function (err) {
                    console.log(err)
                }
            });

        });
    });
</script>
@endsection