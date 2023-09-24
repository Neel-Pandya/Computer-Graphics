    @extends('pages.master')
    @section('title')
        Products
    @endsection

    @section('content')
        <div class="table-container">
            <div class="search mb-3 d-flex justify-content-end align-items-end text-center">
                {{-- FIXME: for live search --}}
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover  text-center  table-bordered ">

                    <thead class="bg-dark text-light text-center">
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Category</th>
                        <th>Product For</th>
                        <th>Product Size</th>
                        <th>Product Image</th>
                        <th>Product Status</th>
                        <th colspan="2">Actions</th>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
            <button class="btn btn-primary mt-4 show-modal">Add Product</button>

            {{-- Add Products Modal --}}
            <div class="modal fade" id="addProductsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5 " id="exampleModalLabel">Add Product</h3>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="addProductForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="add-product-errors alert-danger"></ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                        <label for="" class="form-label">Product Name</label>
                                        <input type="text" id="product_name" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                        <label for="" class="form-label">Product Price</label>
                                        <input type="number" id="product_price" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                        <label for="" class="form-label">Product category</label>
                                        <select name="" id="product_category" class="form-control form-select">
                                            <option value="">Choose Category</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                        <label for="" class="form-label">Product For</label>
                                        <select name="" id="product_for" class="form-control">
                                            <option value="">Choose Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                        <label for="" class="form-label">Product size</label>
                                        <select name="" id="product_size" class="form-control">
                                            <option value="">Choose size</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                        <label for="" class="form-label">Product image</label>
                                        <input type="file" id="product_image" class="form-control">
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

        </div>
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('js/custom.js') }}"></script>
        <script>
            $(document).ready(function() {

                // To show the modal 
                $(document).on('click', '.show-modal', function() {
                    $("#addProductsModal").modal('show')
                });

                // All the required Data
                function getRequiredData() {
                    let buttonLabel
                    let buttonClass
                    $.ajax({
                        type: "GET",
                        url: "get-required-data",
                        success: function(response) {
                            console.log(response.categoryData)

                            // it is for fetching the categories
                            $.each(response.categoryData, function(indexInArray, valueOfElement) {
                                $("#product_category").append(`
                                    <option value='${valueOfElement.category_name}'> ${valueOfElement.category_name} </option>
                                 `)
                            });

                            // It is for fetching the sizes
                            $.each(response.sizeData, function(indexInArray, valueOfElement) {
                                $("#product_size").append(`
                                    <option value='${valueOfElement.size_name}'> ${valueOfElement.size_name} </option>
                                 `);
                            });

                            // it is for fetching the products
                            $("tbody").html('')
                            $.each(response.products, function(indexInArray, valueOfElement) {
                                
                                if (valueOfElement.Product_status == 'Active') {
                                    buttonLabel = "Deactivate"
                                    buttonClass = "btn btn-danger button-deactivate"
                                } else if (valueOfElement.Product_status == 'Inactive') {
                                    buttonLabel = "Active"
                                    buttonClass = "btn btn-success button-activate"
                                } else if (valueOfElement.Product_status == 'Deleted') {
                                    buttonLabel = "Reactivate"
                                    buttonClass = "btn btn-danger button-reactivate"
                                }
                                $("tbody").append(`
                                    <tr>
                                        <td>${valueOfElement.Product_id}</td>
                                        <td>${valueOfElement.Product_name}</td>
                                        <td>${valueOfElement.Product_price}</td>
                                        <td>${valueOfElement.Product_category}</td>
                                        <td>${valueOfElement.Product_for}</td>
                                        <td>${valueOfElement.Product_size}</td>
                                        <td><img src='{{ URL::to('/') }}/images/products/${valueOfElement.Product_image}'></td>
                                        <td><button class='${buttonClass}'>${buttonLabel}</button></td>
                                        <td><button class='btn btn-primary button-edit'>Edit</button></td>
                                        <td><button class='btn btn-danger button-delete'>Delete</button></td>
                                    </tr>
                                        
                                `)
                            });
                        }
                    });


                }
                // This is used to show required data like categories , sizes and all table data  
                getRequiredData()

                $(document).on('submit', '#addProductForm', function(event) {
                    event.preventDefault()
                    let formData = new FormData(this)
                    formData.append("product_name", $("#product_name").val())
                    formData.append("product_price", $("#product_price").val())
                    formData.append("product_category", $("#product_category").val())
                    formData.append("product_for", $("#product_for").val())
                    formData.append("product_size", $("#product_size").val())
                    formData.append("product_image", $("#product_image")[0].files[0])


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        method: "POST",
                        url: "product_store",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 'validation_error') {
                                console.log(response.message)
                                $(".add-product-errors").html("")
                                $.each(response.message, function(indexInArray, valueOfElement) {
                                    $(".add-product-errors").append(
                                        `<li style='list-style:none;'>${valueOfElement} </li>`
                                    )
                                });
                            } else {
                                $(".add-product-errors").html("")
                            }

                            if (response.status == 'success') {
                                $("#addProductsModal").modal('hide')
                                sweetAlert("success", response.message)
                                getRequiredData()
                                $("#addProductsModal").find('input').val("")
                                $("#product_for").val("")
                                $("#product_size").val("")
                                $("#product_category").val("")
                                

                            } else if (response.status == 'failed') {
                                $("#addProductsModal").modal('hide')
                                sweetAlert("error", response.message)
                                $("#addProductsModal").find('input').val("")
                                $("#product_for").val("")
                                $("#product_size").val("")
                                $("#product_category").val("")
                            }
                        }
                    });
                });

            });
        </script>
    @endsection
