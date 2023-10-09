@extends('guest.master')

@section('titles')
Products
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/products.css') }}">

<h2 class="main-head-of-products">Everyone Has A Style Statment<br>
    <span class="colored-word-bigger-size">FIND YOURS HERE!</span>
</h2>

<br>
<div class="bg-images">
    <a href="{{ route('products.available') }}"><img
            src="{{ URL::to('/') }}/images/products-img/marcus-loke-xXJ6utyoSw0-unsplash (1).jpg" alt=""></a>
</div>

<center>
    <p class="msg-ps">
        <span class="colored-word">Click</span> on the product to add in your shopping list.
        <br>Go below and check <span class="colored-word">YOUR CART</span> for details.
    </p>
</center>

<h1>For <span class="colored-word">Her</span></h1>
<div class="jeans">
    @foreach($productForFemale as $productFemale)
    <img src="{{ URL::to('/') }}/images/products/{{ $productFemale->Product_image }}" alt="" style="width:50%; ">
    @endforeach
</div>

<br><br>
</div>

<h1>For <span class="colored-word">Him</span></h1>
<div class="jeans">
    @foreach ($productForMale as $productMale)
    <img src="{{ URL::to('/') }}/images/products/{{ $productMale->Product_image }}" alt="" style="width: 50%; ">
    @endforeach
</div>
@endsection