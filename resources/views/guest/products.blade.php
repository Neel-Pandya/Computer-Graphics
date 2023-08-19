@extends('guest.master')

@section('titles')

Products

@endsection

@section('content')

<h2 class="main-head-of-products">Everyone Has A Style Statment<br>
    <span class="colored-word-bigger-size">FIND YOURS HERE!</span>
</h2>

<br>
<div class="bg-images">
    <a href="products.html"><img src="{{ URL::to('/') }}/images/products-img/marcus-loke-xXJ6utyoSw0-unsplash (1).jpg" alt=""></a>
</div>

<center>
    <p class="msg-ps">
        <span class="colored-word">Click</span> on the product to add in your shopping list.
        <br>Go below and check <span class="colored-word">YOUR CART</span> for details.
    </p>
</center>

<div>
    <h1>For <span class="colored-word">Her</span></h1>
    <center>
        <hr class="products-hr">
    </center>
    <br><br>

    <div class="kurti">
        <img src="{{ URL::to('/') }}/images/products-img/women/kurti1.png" id="AKS  Kurta with Plazzzo & Dupatta || Rs.1799">

        <img src="{{ URL::to('/') }}/images/products-img/women/kurti2.png"
            id="Nayo Women Solid Kurta with Trouser || Rs.1649"" alt="" >
        <img src="{{ URL::to('/') }}/images/products-img/women/kurti3.png" id="AKS Printed Staight Kurta || Rs.659" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/kurti4.png" id="Fabindia Slim Fit Straight Kurta || Rs.1990" alt=""">
    </div>
    <div class="western">
        <img src="{{ URL::to('/') }}/images/products-img/women/western1.png" id="Ives Solid Shirt Style Top || Rs.549" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/western2.png" id="Style Quotient Solid Top || Rs.554" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/western3.png" id="HERE&NOW Printed A-Line Top || Rs.549" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/western4.png" id="SASSAFRAS Ruffled Shirt Style Top || Rs. 549" alt="">
    </div>
    <div class="g-shoes">
        <img src="{{ URL::to('/') }}/images/products-img/women/g-shoe1.png" id=" PUMA Women LQDCell || Rs.6999" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/g-shoe2.png" id="ADIDAS Women Ultraboost19 Running || Rs.11899" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/g-shoe3.png" id="HRX Womwn Abslute Run  || Rs.1549" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/g-shoe4.png" id="Skercher Women GO RUN  || Rs.3249" alt="">
    </div>
    <div class="heels">
        <img src="{{ URL::to('/') }}/images/products-img/women/heels1.png" id="Shetopia Women Heels || Rs.499" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/heels2.png" id="ZAPATOZ Women Heeled Boots || Rs.527" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/heels3.png" id="Allen Solly Women Solid Wedged || Rs.2499" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/women/heels4.png" id="Shoetopia Women Heels || Rs.499" alt="">
    </div>

    <h1>For <span class="colored-word">Him</span></h1>
    <center>
        <hr class="products-hr">
    </center>
    <br><br>

    <div class="shirts">
        <img src="{{ URL::to('/') }}/images/products-img/men/shirt1.png" id="Difference of Opinion Printed Shirt || Rs.449" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/shirt2.png" id="Moda Rapido Printed Round Neck T-shirt || Rs.486" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/shirt3.png" id="DILLINGER Colourblocked Round Neck T-shirt || Rs.404" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/shirt4.png" id="Roadster T-shirt with Shoulder patch || Rs.519" alt="">
    </div>
    <div class="jeans">
        <img src="{{ URL::to('/') }}/images/products-img/men/jeans1.png" id="HIGHLANDER Men Slim Fit Jeans || Rs.874" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/jeans2.png" id="Roadster Men Super Skinny Fit Jeans || Rs.1199" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/jeans3.png" id="Calvin Klein Jeans Mean Slim Straight Jeans || Rs.9599" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/jeans4.png" id="LOCOMOTIVE Mean Slim Fit Jeans || Rs.999" alt="">
    </div>
    <div class="joggers">
        <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934" alt="">
    </div>
    <div class="shoes">
        <img src="{{ URL::to('/') }}/images/products-img/men/shoe1.png" id="PUMA Men Clasp IDP Sneakers || Rs.1304" alt="">
        <img src="{{ URL::to('/') }}/images/products-img/men/shoe2.png" id="Levis Men Sneakers || Rs.1169" alt="" onclick="add(this.id)">
        <img src="{{ URL::to('/') }}/images/products-img/men/shoe3.png" id="Mactree Men Sneakers || Rs.679" alt="" onclick="add(this.id)">
        <img src="{{ URL::to('/') }}/images/products-img/men/shoe4.png" id="HRX Men Pro Sneakers || Rs.1699" alt="" onclick="add(this.id)">
    </div><br>

    <h4 class="sry-msg">Uh-Oh! We are<span class="colored-word"> done</span>🛒</h4>
    <center>
        <hr class="last-hr-of-product">
    </center>
    <br><br>

  
</div>


@endsection


