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
<div class="jeans female">

</div>

<br><br>
</div>

<h1>For <span class="colored-word">Him</span></h1>
<div class="jeans male">

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>

<script>
    $(function () {
        const loadProductsForMale = () => {
            $(".male").html('')
            $.ajax({
                type: "GET",
                url: "{{ route('products.male') }}",
                success: function (response) {
                    $.each(response.products, function (indexInArray, valueOfElement) {
                        const { Product_category, Product_for, Product_id, Product_image, Product_name, Product_price, Product_size } = valueOfElement

                        $(".male").append(`
                        <div class="card" style="width: 18rem;">
                            <img src="{{ URL::to('/') }}/images/products/${Product_image}" class="card-img-top img-sm" alt="..." >
                            <div class="card-body">
                                
                                <h5 class="card-title" style="margin-top: -15px ">${Product_name}</h6>
                                <h6 class='card-text'>Price - ${Product_price} Rs</h6>
                                <h6 class='card-text'>Sizes - ${Product_size}</h6>

                                @if (session()->has('user_email') and session()->has('user_password'))
                                
                                 <button class='text-center btn btn-primary col-12 mt-2 add-to-cart' data-id="${Product_id}"
                                    data-category='${Product_category}'
                                    data-for='${Product_for}'
                                    data-image='${Product_image}'
                                    data-name="${valueOfElement.Product_name}"
                                    data-price='${Product_price}'
                                    data-size='${Product_size}'
                                    data-quantity="1"
                                 > Add to Cart </button>
                                @endif
                            </div>
                        </div>
                        `)

                    });
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }

        const loadProductsForFemale = () => {
            $(".female").html('')
            $.ajax({
                type: "GET",
                url: "{{ route('products.female') }}",
                success: function (response) {
                    $.each(response.products, function (indexInArray, valueOfElement) {
                        const { Product_category, Product_for, Product_id, Product_image, Product_name, Product_price, Product_size } =
                            valueOfElement

                        $(".female").append(`
                        
                        <div class="card" style="width: 18rem;">
                            <img src="{{ URL::to('/') }}/images/products/${Product_image}" class="card-img-top img-sm" alt="..." >
                            <div class="card-body">
                                
                                <h5 class="card-title" style="margin-top: -15px ">${Product_name}</h6>
                                <h6 class='card-text'>Price - ${Product_price} Rs</h6>
                                <h6 class='card-text'>Sizes - ${Product_size}</h6>

                                @if (session()->has('user_email') and session()->has('user_password'))
                                
                                 <button class='text-center btn btn-primary col-12 mt-2 add-to-cart' data-id='${Product_id}'
                                    data-category='${Product_category}'
                                    data-for='${Product_for}'
                                    data-image='${Product_image}'
                                    data-name="${Product_name}"
                                    data-price='${Product_price}'
                                    data-size='${Product_size}'
                                    data-quantity="1"
                                 
                                 
                                 > Add to Cart </button>
                                
                                @endif

                                
                            </div>
                        </div>
                        
                        `)
                    });
                }
            });
        }
        loadProductsForFemale()
        loadProductsForMale()

        $(document).on('click', '.add-to-cart', function (e) {
            let itemId = $(this).data('id')

            const productData = {
                Product_category: $(this).data('category'),
                Product_for: $(this).data('for'),
                Product_id: $(this).data('id'),
                Product_image: $(this).data('image'),
                Product_name: $(this).data('name'),
                Product_price: $(this).data('price'),
                Product_size: $(this).data('size'),
                Quantity: $(this).data('quantity')
            };

            const formData = new FormData(this);
            formData.append('id', itemId)
            formData.append('email', "{{ session()->get('user_email') }}")
            formData.append("Product_id", productData.Product_id);
            formData.append('Product_name', productData.Product_name)
            formData.append('Product_price', productData.Product_price)
            formData.append('Product_category', productData.Product_category)
            formData.append('Product_for', productData.Product_for)
            formData.append('Product_size', productData.Product_size)
            formData.append('Product_image', productData.Product_image)
            formData.append('Quantity', productData.Quantity)


            // console.log(productData)



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/guest_user/add-to-cart",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)
                },
                error: function (error) {
                    console.log(error)
                }
            });
        });
    });
</script>
@endsection