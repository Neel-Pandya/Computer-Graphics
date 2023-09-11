@extends('guest.master')

@section('titles')
    Products
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <h2 class="main-head-of-products">Everyone Has A Style Statment<br>
        <span class="colored-word-bigger-size">FIND YOURS HERE!</span>
    </h2>

    <br>
    <div class="bg-images">
        <a href="products.html"><img src="{{ URL::to('/') }}/images/products-img/marcus-loke-xXJ6utyoSw0-unsplash (1).jpg"
                alt=""></a>
    </div>

    <center>
        <p class="msg-ps">
            <span class="colored-word">Click</span> on the product to add in your shopping list.
            <br>Go below and check <span class="colored-word">YOUR CART</span> for details.
        </p>
    </center>

    <div class="">
        <h1>For <span class="colored-word">Her</span></h1>

        <br><br>

        <div class="container shirts">
            @foreach ($productData as $product)
                {{-- <div class="col-lg-3 col-md-6 col-sm-12 shirts">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ URL::to('/') }}/images/products/{{ $product->Product_image }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div> --}}
                <img src="{{ URL::to('/') }}/images/products/{{ $product->Product_image }}" alt="" style="width: 60%">

                <a href="#" class="btn btn-primary">Add to cart</a>
                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                    the
                    card's content.</p> --}}
                @endforeach

        </div>
        <h1>For <span class="colored-word">Him</span></h1>

        <br><br>

        <div class="shirts">
            <img src="{{ URL::to('/') }}/images/products-img/men/shirt1.png"
                id="Difference of Opinion Printed Shirt || Rs.449" alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/shirt2.png"
                id="Moda Rapido Printed Round Neck T-shirt || Rs.486" alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/shirt3.png"
                id="DILLINGER Colourblocked Round Neck T-shirt || Rs.404" alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/shirt4.png"
                id="Roadster T-shirt with Shoulder patch || Rs.519" alt="">
        </div>
        <div class="jeans">
            <img src="{{ URL::to('/') }}/images/products-img/men/jeans1.png" id="HIGHLANDER Men Slim Fit Jeans || Rs.874"
                alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/jeans2.png"
                id="Roadster Men Super Skinny Fit Jeans || Rs.1199" alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/jeans3.png"
                id="Calvin Klein Jeans Mean Slim Straight Jeans || Rs.9599" alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/jeans4.png" id="LOCOMOTIVE Mean Slim Fit Jeans || Rs.999"
                alt="">
        </div>
        <div class="joggers">
            <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934"
                alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934"
                alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934"
                alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/joggers1.png" id="HRX Men Solid Joggers || Rs.934"
                alt="">
        </div>
        <div class="shoes">
            <img src="{{ URL::to('/') }}/images/products-img/men/shoe1.png" id="PUMA Men Clasp IDP Sneakers || Rs.1304"
                alt="">
            <img src="{{ URL::to('/') }}/images/products-img/men/shoe2.png" id="Levis Men Sneakers || Rs.1169"
                alt="" onclick="add(this.id)">
            <img src="{{ URL::to('/') }}/images/products-img/men/shoe3.png" id="Mactree Men Sneakers || Rs.679"
                alt="" onclick="add(this.id)">
            <img src="{{ URL::to('/') }}/images/products-img/men/shoe4.png" id="HRX Men Pro Sneakers || Rs.1699"
                alt="" onclick="add(this.id)">
        </div><br>

        <h4 class="sry-msg">Uh-Oh! We are<span class="colored-word"> done</span>🛒</h4>
        <center>
            <hr class="last-hr-of-product">
        </center>
        <br><br>


    </div>
@endsection
