$(document).ready(function () {

    // Fetching All data
    function loadAllCoupens() {
        $.ajax({
            method: "GET",
            url: "load_coupen",
            dataType: "json",
            success: function (response) {
                $("tbody").html("")

                $.each(response.data, function (indexInArray, valueOfElement) {
                    $("tbody").append(
                        `<tr> 
                            <td> ${valueOfElement.id} </td>
                            <td> ${valueOfElement.coupen_name}</td>
                            <td> ${valueOfElement.Quantity}</td>
                            <td> ${valueOfElement.expire_date} </td>
                            <td> ${valueOfElement.discount} </td>
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
});
