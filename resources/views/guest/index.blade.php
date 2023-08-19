@extends('guest.master')
@section('titles')

Home 
@endsection 

@section('content')

<div class="index-main-img">
    <a><img id="main-index-img" src="{{ URL::to('/') }}/images/index-img/Off-the-Wall.jpg" alt="" srcset=""></a>
</div>

<br>

<div class="index-offers-img">
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/index-img/1.png" alt=""></a>
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/index-img/2.png" alt=""></a>
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/index-img/3.png" alt=""></a>
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/index-img/4.png" alt=""></a>
</div>

<br><br>

<div class="index-grid-img-1">
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/index-img/anton-levin-P8prss71psk-unsplash.jpg" alt="" srcset=""></a>
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/index-img/bogdan-glisik-2WgOPYJuPsU-unsplash (1).jpg" alt=""
            srcset=""></a>
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/index-img/calvin-lupiya--yPg8cusGD8-unsplash.jpg" alt=""></a>
    <a href="{{ route('guest.category') }}">
        <h4 class="info-of-img-below">For the Young, Wild & Stylish</h4>
    </a>
    <a href="categories.html">
        <h4 class="info-of-img-below">Just like your way to Conquer</h4>
    </a>
    <a href="categories.html">
        <h4 class="info-of-img-below">Stands out like the Sun</h4>
    </a>
</div>
<!-- ALL THE LINKS WILL GO TO categories.html -->

<br> <br> <br>

<h2 class="head-of-offer">TRENDING NOW</h2><br>
<p class="para-of-offer">From the runway to your wadrobe</p>

<br><br>

<!-- ALL THE LINKS WILL GO TO products.html -->
<div class="index-grid-img-2">
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/ethan-haddox-QHGcADeeT00-unsplash.jpg" id="trans-img"
            alt=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/andres-jasso-PqbL_mxmaUE-unsplash (1).jpg" alt=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/raul-hender-afc4HxPy2GM-unsplash (1).jpg" alt=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/nike.png" alt="" srcset=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/my-shoes2.png" alt="" srcset=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/my-shoes3.png" alt="" srcset=""></a>
</div>

<h2 class="head-of-offer">STYLES TO STEAL</h2><br>
<p class="para-of-offer">Inspired by influencer</p>

<br><br>

<div class="index-grid-img-3">
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/girl1.png" alt=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/girl2.png" alt="" srcset=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/girl3.png" alt=""></a>
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/index-img/girl4.png" alt="" srcset=""></a>
</div>
<!-- ALL THE LINKS WILL GO TO products.html -->

@endsection