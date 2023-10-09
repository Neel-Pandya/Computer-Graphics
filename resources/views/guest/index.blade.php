@extends('guest.master')
@section('titles')
Home
@endsection

@section('content')

<div class="index-main-img">
    <a><img id="main-index-img" src="{{ URL::to('/') }}/images/products/{{ $homeData->image }}" alt="" srcset=""></a>
</div>

<br>

<div class="index-offers-img">
    @foreach ($homeAllData as $item )
    <a href="{{ route('guest.category') }}"><img src="{{ URL::to('/') }}/images/products/{{ $item->image }}" alt=""></a>
    @endforeach
</div>

<br><br>

<!-- ALL THE LINKS WILL GO TO categories.html -->

<br> <br> <br>

<h2 class="head-of-offer">TRENDING NOW</h2><br>
<p class="para-of-offer">From the runway to your wadrobe</p>

<br><br>

<!-- ALL THE LINKS WILL GO TO products.html -->
<div class="index-grid-img-2">
    @foreach ($trending as $trend )
    <a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/products/{{ $trend->image }}"
            alt=""></a>

    @endforeach
</div>

<h2 class="head-of-offer">STYLES TO STEAL</h2><br>
<p class="para-of-offer">Inspired by influencer</p>

<br><br>

<div class="index-grid-img-3">
    @foreach ($products as $item)
    <a href=""><img src="{{ URL::to('/') }}/images/products/{{ $item->Product_image }}" alt=""></a>
    @endforeach
</div>
<!-- ALL THE LINKS WILL GO TO products.html -->

@endsection