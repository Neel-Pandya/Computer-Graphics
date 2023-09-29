$(document).ready(function () {

    let url = "http://127.0.0.1:8000/admin/sizes/";
    // Showing the modal on the click of Add Sizes button
    $(document).on('click', '.button-add-size', function () {
        $("#addSizesModal").modal('show')
    });

    const loadAllSizes = () => {
        $.ajax({
            type: "GET",
            url: url + "get-data",
            success: function (response) {
                let buttonClass, buttonText

                $("tbody").html("")
                $.each(response.size, function (indexInArray, valueOfElement) {
                    if (valueOfElement.status == 'Active') {
                        buttonClass = 'btn btn-danger button-deactivate'
                        buttonText = 'Deactivate'
                    }
                    else {
                        buttonClass = 'btn btn-success button-activate'
                        buttonText = "Activate"
                    }

                    $("tbody").append(
                        `
                        <tr> 
                        <td>${valueOfElement.id}</td>
                        <td>${valueOfElement.size_name}</td>
                        <td><button class='${buttonClass}' value='${valueOfElement.id}'> ${buttonText} </button> </td>
                        <td><button class='btn btn-primary button-edit' value='${valueOfElement.id}'>Edit</button></td>
                        <td><button class='btn btn-danger button-delete' value='${valueOfElement.id}'>Delete</button></td>
                        </tr>
                        `

                    )
                });
            }
        });
    }
    loadAllSizes()

    // Inserting the sizes using formdata
    $(document).on('submit', '#addSizesForm', function (event) {
        event.preventDefault()
        let formdata = new FormData(this)
        formdata.append("size_name", $("#size-name").val())

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: url + "store",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'validation') {

                    $(".size-errors").html("")
                    $.each(response.errors, function (indexInArray, valueOfElement) {
                        $(".size-errors").append(`
                        <li style='list-style:none;'> ${valueOfElement} </li>
                    `)
                    });

                }
                else {
                    $(".size-errors").html("")
                }
                if (response.status == 'success') {
                    $("#addSizesModal").modal('hide')
                    sweetAlert('success', response.message)
                    loadAllSizes()
                    $("#addSizesForm").find('input').val("")
                }
                else if (response.status == 'failed') {
                    $("#addSizesModal").modal('hide')
                    sweetAlert('error', response.message)
                }
            }
        });
    });

    // Deactivate the sizes
    $(document).on('click', '.button-deactivate', function () {
        let buttonValue = $(this).val()

        $.ajax({
            type: "GET",
            url: url + `deactivate/${buttonValue}`,
            success: function (response) {
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllSizes()
                }
                else {
                    sweetAlert('error', response.message)
                }
            }
        });
    });

    // Activate the sizes

    $(document).on('click', '.button-activate', function () {
        let buttonValue = $(this).val()

        $.ajax({
            type: "GET",
            url: url + `activate/${buttonValue}`,
            success: function (response) {
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllSizes()
                }
                else {
                    sweetAlert('error', response.message)
                }
            }
        });
    });


    // Delete Operation
    $(document).on('click', '.button-delete', function () {
        let buttonValue = $(this).val()

        $.ajax({
            type: "GET",
            url: url + `delete/${buttonValue}`,
            success: function (response) {
                if (response.status == 'success') {
                    sweetAlert('success', response.message)
                    loadAllSizes()
                }
                else {
                    sweetAlert('error', response.message)
                }
            }
        });
    });

    // Edit
    $(document).on('click', '.button-edit', function () {
        let buttonValue = $(this).val()

        $.ajax({
            type: "GET",
            url: url + `edit/${buttonValue}`,
            success: function (response) {
                $("#editSizesModal").modal('show')
                $("#edit-size-name").val(response.sizes.size_name)
                $("#size_id").val(response.sizes.id)
            }
        });
    });
    $(document).on('submit', '#editSizesForm', function (event) {
        event.preventDefault()
        let formdata = new FormData(this)
        formdata.append('id', $("#size_id").val())
        formdata.append('size_name', $("#edit-size-name").val())

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: url + "update",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == 'validation') {
                    $(".edit-size-errors").html("")
                    $.each(response.error, function (indexInArray, valueOfElement) {
                        $(".edit-size-errors").append(`<li style='list-style:none;'>${valueOfElement} </li>`)
                    });
                }
                else {
                    $(".edit-size-errors").html("")
                }
                if (response.status == 'success') {
                    $("#editSizesModal").modal('hide')
                    sweetAlert('success', response.message)
                    loadAllSizes()
                }
                else if (response.status == 'failed') {
                    $("#editSizesModal").modal('hide')
                    sweetAlert('error', response.message)
                }
            }
        });
    });
});