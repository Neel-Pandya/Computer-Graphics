@extends('pages.master')
@section('title')
    Customers Details
@endsection
@section('content')
    <div class="table-responsive">
        <table class="table  table-striped  table-bordered">

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
            </tbody>
        </table>
    </div>
    <button class="btn btn-info add-customers mt-4">Add
        Customer</button>
    </div>



    {{-- Edit Customers Modal --}}
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5 col-12 text-center" id="exampleModalLabel">Add Customers</h3>

                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="addCustomer">
                        <div class="row">
                            <div class="col-12">
                                <ul class="customer-error-messages alert-danger"></ul>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Email</label>
                                <input type="email" id="customer_email" name="customer_email" class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Mobile</label>
                                <input type="tel" name="customer_mobile" id="customer_mobile" class="form-control">
                            </div>

                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Password</label>
                                <input type="password" id="customer_password" name="customer_password" class="form-control">
                            </div>

                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Choose Genders</label>
                                <select id="customer_gender" name="customer_gender" class="form-control form-select">
                                    <option value="">Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Choose profile picture</label>
                                <input type="file" name="customer_profile" id="customer_profile" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary add-customer-button">Add</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5 col-12 text-center" id="exampleModalLabel">Edit Customers</h3>

                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="addCustomer">
                        <div class="row">
                            <div class="col-12">
                                <ul class="customer-edit-error-messages alert-danger"></ul>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Name</label>
                                <input type="text" name="edit_customer_name" id="edit_customer_name"
                                    class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Email</label>
                                <input type="email" id="edit_customer_email" name="customer_email"
                                    class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Mobile</label>
                                <input type="tel" name="customer_mobile" id="edit_customer_mobile"
                                    class="form-control">
                            </div>

                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Customer Password</label>
                                <input type="password" id="edit_customer_password" name="customer_password"
                                    class="form-control">
                            </div>

                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Choose Genders</label>
                                <select id="edit_customer_gender" name="customer_gender"
                                    class="form-control form-select">
                                    <option value="">Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="" class="form-label">Choose profile picture</label>
                                <input type="file" name="customer_profile" id="edit_customer_profile"
                                    class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary edit-customer-button">Add</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(function() {
            // To Show the Modal
            $(document).on('click', '.add-customers', function() {
                $("#addCustomerModal").modal('show')
            });


            // Load All of the users
            function loadAllUsers(image_path) {
                $.ajax({
                    type: "GET",
                    url: "get-all-customers",
                    dataType: "json",
                    success: function(response) {
                        let buttonLabel = "";
                        let buttonClass = "";

                        $("tbody").html("");
                        $.each(response.data, function(indexInArray, valueOfElement) {

                            // Check if the status is Active, Inactive or Deleted
                            if (valueOfElement.customer_status === 'Active') {
                                buttonLabel = "Deactivate";
                                buttonClass = "btn btn-danger button-deactivate";
                            } else if (valueOfElement.customer_status === 'Inactive') {
                                buttonLabel = "Activate";
                                buttonClass = "btn btn-success button-activate";
                            } else if (valueOfElement.customer_status === 'Deleted') {
                                buttonLabel = "Reactivate";
                                buttonClass = "btn btn-danger button-reactivate";
                            }

                            // Showing the data in the table
                            $("tbody").append(
                                `<tr>
                                <td>${valueOfElement.id}</td>
                                <td>${valueOfElement.customer_name}</td>
                                <td>${valueOfElement.customer_email}</td>
                                <td>${valueOfElement.customer_gender}</td>
                                <td>${valueOfElement.customer_mobile}</td>
                                <td><img src="{{ URL::to('/') }}/images/profiles/${valueOfElement.customer_profile}"></td>
                                <td><button class='${buttonClass}' value='${valueOfElement.id}'>${buttonLabel}</button></td>
                                <td><button class='btn btn-primary button-edit' value='${valueOfElement.id}'>Edit</button></td>
                                <td><button class='btn btn-danger button-delete' value='${valueOfElement.id}'>Delete</button></td>
                            </tr>`
                            )
                        });
                    }
                });
            }

            loadAllUsers();

            // To store the input Fields
            $(document).on('submit', "#addCustomer", function(event) {
                event.preventDefault();

                // Create a FormData object
                var formData = new FormData();

                // Append form fields to the FormData object
                formData.append("customer_name", $("#customer_name").val());
                formData.append("customer_email", $("#customer_email").val());
                formData.append("customer_mobile", $("#customer_mobile").val());
                formData.append("customer_password", $("#customer_password").val());
                formData.append("customer_gender", $("#customer_gender").val());

                // Append the image file to the FormData object
                let selectedFile = $("#customer_profile")[0].files[0]
                if (selectedFile) {
                    formData.append("customer_profile", $("#customer_profile")[0].files[0]);
                }

                // Set up CSRF token header
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Send the AJAX request with FormData
                $.ajax({
                    type: "POST",
                    url: "customer_store",
                    data: formData, // Use the FormData object
                    processData: false, // Important: prevent jQuery from processing data
                    contentType: false, // Important: prevent jQuery from setting content type
                    success: function(response) {
                        $(".customer-error-messages").html("");
                        if (response.status == 'errors') {
                            $.each(response.error, function(indexInArray, valueOfElement) {
                                $(".customer-error-messages").append(
                                    `<li style='list-style:none;'>${valueOfElement}</li>`
                                );
                            });
                        } else if (response.status == 'success') {
                            $("#addCustomerModal").modal('hide')

                            sweetAlert("success", response.message);
                            loadAllUsers();
                            $("#addCustomerModal").find('input').val("")
                            $("#customer_gender").val('')

                        } else if (response.status == 'failed') {
                            $("#addCustomerModal").modal('hide')

                            sweetAlert("error", response.message);
                            $("#addCustomerModal").find('input').val("")
                            $("#customer_gender").val('')
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', status, error);
                    }
                });
            });

            // Deactivate the status
            $(document).on('click', '.button-deactivate', function() {
                let id = $(this).val()

                $.ajax({
                    type: "GET",
                    url: `deactivate/${id}`,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            sweetAlert("success", response.message)
                            loadAllUsers()
                        } else {
                            sweetAlert("error", response.message)
                        }
                    }
                });
            });

            // Activate the status
            $(document).on('click', '.button-activate', function() {
                let id = $(this).val()

                $.ajax({
                    type: "GET",
                    url: `activate/${id}`,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            sweetAlert("success", response.message)
                            loadAllUsers()
                        } else {
                            sweetAlert("error", response.message)
                        }
                    }
                });
            });


            // Deleting the user
            $(document).on('click', '.button-delete', function() {
                let value = $(this).val()
                $.ajax({
                    type: "GET",
                    url: `delete/${value}`,
                    success: function(response) {
                        if (response.status == 'success') {
                            sweetAlert("success", response.message)
                            loadAllUsers()
                        } else if (response.status == 'failed') {
                            sweetAlert("error", response.message)
                            loadAllUsers()
                        } else if (response.status == 404) {
                            sweetAlert('error', response.message);
                        }
                    }

                });
            });


            // Reactivate the status
            $(document).on('click', '.button-reactivate', function() {
                let value = $(this).val()

                $.ajax({
                    type: "GET",
                    url: `reactivate/${value}`,
                    success: function(response) {
                        if (response.status == 'success') {
                            sweetAlert('success', response.message)
                            loadAllUsers();
                        } else if (response.status == 'failed') {
                            sweetAlert('error', response.message)
                        } else if (response.status == 404) {
                            sweetAlert('error', reponse.message)
                        }
                    }
                });
            });

            // Getting the data based per the id's
            $(document).on('click', '.button-edit', function() {
                let value = $(this).val()

                $.ajax({
                    type: "GET",
                    url: `customer_edit/${value}`,
                    success: function(response) {
                        if (response.status == 'success') {
                            $("#editCustomerModal").modal('show')

                        } else if (response.status == 404) {
                            sweetAlert("error", response.message)
                        }
                    }
                });
            });

        });
    </script>
@endsection
