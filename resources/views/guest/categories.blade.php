@extends('guest.master')

@section('titles')

Categories 

@endsection
@section('content')


<h1 class="main-head-of-color-gold">Unskippable Categories</h1>
<center><hr></center> 
<div class="product-img">
  <img class="product-center-img" src="{{ URL::to('/') }}/images/categories-img/nordwood-themes-Nv4QHkTVEaI-unsplash (1).jpg" alt="" srcset="">
</div> 
<br> <br>
<center><h2 class="trends-header">TRENDING NOW</h2></center><br><br>
<div class="trends-categories">
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/category1.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/category2.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/category3.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/category4.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/category5.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/category6.png" alt=""></a>
</div><br><br>
<center><h2 class="trends-header">+For Her</h2></center><br><br>
<div class="for-her">
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/for-her1.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/for-her2.png" alt=""></a>
</div><br><br>
<center><h2 class="trends-header">+For Him</h2></center><br>
<div class="for-him">
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/brands-for-him1.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/brands-for-him2.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/brands-for-him3.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/brands-for-him4.png" alt=""></a>
<a href="{{ route('guest.products') }}"><img src="{{ URL::to('/') }}/images/categories-img/brands-for-him5.png" alt=""></a>
</div>

@endsection