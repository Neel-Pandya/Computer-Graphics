<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/vertical-layout-light/style.css">

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">


                            <h3 class="font-weight-light text-center"> Admin Login</h3>
                            <form class="pt-3" method="POST" id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <ul id="login-error-messages"></ul>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="login_email" placeholder="email">
                                    <span class="text-danger">

                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="login_password" placeholder="Password">
                                    <span class="text-danger">

                                    </span>
                                </div>
                                <div class="mt-3">
                                    <center>
                                        <input type="submit" value="Login" class="btn btn-primary">
                                    </center>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>


</body>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>
<!-- FIXME: do that later -->
<script>
    $(document).ready(function () {

        $(document).on('submit', '#loginForm', function (event) {
            event.preventDefault()
            let formData = new FormData(this)
            formData.append('email', $("#login_email").val())
            formData.append('password', $("#login_password").val())
            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/admin/login_validate",
                data: formData,
                contentType: false,
                processData: false,

                success: function (response) {
                    if (response.status == 'Validation') {
                        $('#login-error-messages').addClass('alert alert-danger');
                        $("#login-error-messages").html("")
                        $.each(response.errors, function (indexInArray, valueOfElement) {
                            $("#login-error-messages").append(`<li style='list-style:none;'>${valueOfElement}</li>`);
                        });
                    }
                    else {
                        $("#login-error-messages").removeClass('alert alert-danger')
                        $("#login-error-messages").html('');
                    }

                    if (response.status == 'success') {
                        Swal.fire({
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                        location.href = "{{ URL::to('/') }}/admin/dashboard"
                        })
                    }
                    else if (response.status == 'failed') {
                        sweetAlert('error', response.message);
                    }

                },
                error: function (err) {
                    console.log(err)
                }
            });
        });

    });
</script>

</html>