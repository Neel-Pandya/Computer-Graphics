@extends('guest.master')

@section('titles')

Categories

@endsection
@section('content')


<h1 class="main-head-of-color-gold">Unskippable Categories</h1>
<center>
  <hr>
</center>
<div class="product-img">
  <img class="product-center-img"
    src="{{ URL::to('/') }}/images/categories-img/nordwood-themes-Nv4QHkTVEaI-unsplash (1).jpg" alt="" srcset="">
</div>
<br> <br>
<center>
  <h2 class="trends-header">TRENDING NOW</h2>
</center><br><br>
<div class="trends-categories">
  @foreach ($trending as $item)
  <a href=""><img src="{{ URL::to('/') }}/images/products/{{ $item->Product_image }}" alt="" style="width: 50%"></a>
  @endforeach
</div><br><br>
<center>
  <h2 class="trends-header">+For Her</h2>
</center><br><br>
<div class="for-her">
  @foreach ($her as $item)
  <a href=""><img src="{{ URL::to('/') }}/images/products/{{ $item->Product_image }}" alt=""></a>

  @endforeach
</div><br><br>
<center>
  <h2 class="trends-header">+For Him</h2>
</center><br>
<div class="for-him">
  @foreach ($him as $item)

  <a href=""><img src="{{ URL::to('/') }}/images/products/{{ $item->Product_image }}" alt=""></a>
  @endforeach
</div>

@endsection