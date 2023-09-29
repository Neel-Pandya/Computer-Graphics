$(document).ready(function () {
    let url = "http://127.0.0.1:8000/admin/category";

    // Load All the categories
    const loadAllCategories = () => {
        $.ajax({
            type: "GET",
            url: url + "/get-data",
            success: function (response) {
                let buttonClass, buttonText
                $("tbody").html("")

                $.each(response.data, function (indexInArray, valueOfElement) {
                    if (valueOfElement.status == 'Active') {
                        buttonClass = "btn btn-danger button-deactivate"
                        buttonText = "Deactivate"
                    }
                    else {
                        buttonClass = "btn btn-success button-activate"
                        buttonText = 'Activate'
                    }
                    $('tbody').append(`
                        <tr> 
                            <td> ${valueOfElement.id} </td>
                            <td> ${valueOfElement.category_name} </td>
                            <td> <button class='${buttonClass}' value='${valueOfElement.id}'> ${buttonText} </button></td>
                            <td> <button class='btn btn-primary button-edit' value='${valueOfElement.id}'>Edit</button></td>
                            <td> <button class='btn btn-danger button-delete' value='${valueOfElement.id}'> 
                            Delete </button></td>
                        </tr>

                    `)
                });
            }
        });
    }

    loadAllCategories()

    // Showing the addCategoryModal
    $(document).on('click', '.add-category-button', function () {
        $("#addCategoryModal").modal('show')
    });

    // Inserting the value through formdata
    $(document).on('submit', '#addCategoryForm', function (event) {
        event.preventDefault()
        let formdata = new FormData(this)
        formdata.append('category_name', $("#category_name").val())
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url + "/category_store",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == 'validation-error') {
                    $(".category-error-messages").html("")
                    console.log(response.message);
                    $.each(response.message, function (indexInArray, valueOfElement) {
                        $(".category-error-messages").append(`
                            <li style='list-style:none;'>${valueOfElement}</li>
                         `)
                    });
                }
                else {
                    $(".category-error-messages").html("")
                }

                if (response.status == 'success') {
                    $("#addCategoryModal").modal('hide')
                    sweetAlert('success', response.message)
                    loadAllCategories()
                    $("#addCategoryForm").find('input').val("")

                }

                else if (response.status == 'error') {
                    $("#addCategoryModal").modal('hide')
                    sweetAlert('error', response.message)
                    $("#addCategoryForm").find('input').val("")

                }
            }
        });
    });

    // Deactivate the  perticular category
    $(document).on('click', '.button-deactivate', function () {
        let buttonValue = $(this).val()

        $.ajax({
            type: "GET",
            url: url + `/deactivate/${buttonValue}`,
            success: function (response) {
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllCategories()
                }
                else {
                    sweetAlert('error', response.message)
                }
            }
        });
    });

    // Activate the perticular Category based on the id's

    $(document).on('click', '.button-activate', function () {
        let buttonValue = $(this).val()
        $.ajax({
            type: "GET",
            url: url + `/activate/${buttonValue}`,
            success: function (response) {
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllCategories()
                }
                else {
                    sweetAlert('error', response.message)
                }
            }
        });
    });

    // Deleting the perticular Category based on the id's
    $(document).on('click', '.button-delete', function () {
        let buttonValue = $(this).val()

        $.ajax({
            type: "GET",
            url: url + `/delete/${buttonValue}`,
            success: function (response) {
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllCategories()
                }
                else {
                    sweetAlert('error', response.message)
                }
            }
        });
    });

    // Show the editModal and on the click of edit button 

    $(document).on('click', '.button-edit', function () {
        let buttonValue = $(this).val()
        $("#editCategoryModal").modal('show')


        $.ajax({
            type: "GET",
            url: url + `/category_edit/${buttonValue}`,
            success: function (response) {

                if (response.status == 'success') {
                    $("#edit-id").val(response.category.id)
                    $("#edit_category_name").val(response.category.category_name)
                }
                else {
                    $("#editCategoryModal").modal('hide')
                    sweetAlert('error', response.message)
                }
            }
        });
    });

    // Updating the category based on the id's
    $(document).on('submit', '#editCategoryForm', function (event) {
        event.preventDefault()

        let formdata = new FormData(this)

        formdata.append('id', $("#edit-id").val())
        formdata.append('category_name', $("#edit_category_name").val())

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: url + `/category_update`,
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == 'validation-failed') {
                    $(".edit-category-error-messages").html("")
                    $.each(response.error, function (indexInArray, valueOfElement) {
                        $(".edit-category-error-messages").append(
                            `
                            <li style='list-style:none;'>${valueOfElement}</li> 
                            `
                        )
                    });
                }
                else {
                    $(".edit-category-error-messages").html("")
                }
                if (response.status == 'success') {
                    $("#editCategoryModal").modal('hide')
                    sweetAlert('success', response.message)
                    loadAllCategories()
                }
                else if (response.status == 'error') {
                    $("#editCategoryModal").modal('hide')
                    sweetAlert('error', response.message)
                }
            }
        });
    });



});