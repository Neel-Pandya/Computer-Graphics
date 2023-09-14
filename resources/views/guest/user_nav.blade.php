<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light fixed-top ">
        <div class="container">
            <a class="navbar-brand" href="#"
                style="font-family: 'Sacramento', cursive;
    font-weight: 500;
    text-align: center;
    color:#f84258;
    font-size:45px;">Merlin
                Fashion</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-link" style="font-family: 'Montserrat', sans-serif;"><a href="{{ route('guest.create') }}"
                            class="{{ request()->routeIs('guest.create') ? 'active' : '' }} text-decoration-none ms-3">Home</a>
                    </li>

                    <li class="nav-link" style="font-family: 'Montserrat', sans-serif;"><a href="{{ route('guest.products') }}"
                            class="{{ request()->routeIs('guest.products') ? 'active' : '' }} text-decoration-none ms-3">Products</a>
                    </li>
                    <li class="nav-link" style="font-family: 'Montserrat', sans-serif;"><a href="{{ route('guest.category') }}"
                            class="{{ request()->routeIs('guest.category') ? 'active' : '' }} text-decoration-none ms-3">Categories</a>
                    </li>
                    <li class="nav-link" style="font-family: 'Montserrat', sans-serif;"><a href="{{ route('guest.contact') }}"
                            class="{{ request()->routeIs('guest.contact') ? 'active' : '' }} text-decoration-none ms-3">ContactUs</a>
                    </li>
                    <li class="nav-link" style="font-family: 'Montserrat', sans-serif;"><a href="{{ route('guest.login') }}"
                            class="{{ request()->routeIs('guest.login') ? 'active' : '' }} text-decoration-none ms-3">Login</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
