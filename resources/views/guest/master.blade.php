<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titles')</title>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Chivo:300,700|Playfair+Display:700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Beth+Ellen&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nova+Cut|Nova+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/style_index.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/merlin.css">
    <link rel="styleheet" href="{{ URL::to('/') }}/css/demo.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/nav.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/products.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/categories.css">


</head>

<body>
    {{--  User navbar --}}

    @include('guest.user_nav')
    {{-- User navbar end --}}

    @yield('content')

    @include('guest.user_foot')




    <script type="text/javascript" src="{{ URL::to('/') }}/js/nav.js"></script>
    <script type="text/javascript" src="{{ asset('js/products.js') }}""></script>
    @stack('scripts')

</body>

</html>
