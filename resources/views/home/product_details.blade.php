<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    {{-- <base href="/public"> --}}
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css')}}" />
    <!-- Font Awesome -->
    <link href="{{ asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="{{ asset('home/css/responsive.css')}}" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- Header section starts -->
        @include('home.header')
        <!-- End header section -->

        {{-- Body --}}

        <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:30%; padding:30px">
            <div class="img-box">
                <img src="/product/{{ $product->image }}" style="width: 100%; height: 100%;">
            </div>
            <div class="detail-box">
                <h5 style="margin-bottom: 10px;">
                    {{ $product->title }}
                </h5>

                @if ($product->discount_price != NULL)
                <h6 style="color: #e74c3c; margin-bottom: 5px;">
                    Discount Price: ${{ $product->discount_price }}
                </h6>
                <h6 style="text-decoration: line-through; color: #95a5a6; margin-bottom: 5px;">
                    Original Price: ${{ $product->price }}
                </h6>
                @else
                <h6 style="color: #2ecc71; margin-bottom: 5px;">
                    Price: ${{ $product->price }}
                </h6>
                @endif

                <h6>Product Category: {{ $product->catagory }}</h6>
                <h6>Product Details: {{ $product->description }}</h6>
                <h6>Available Quantity: {{ $product->quantity }}</h6>

                <form action="{{ url('add_cart' , $product->id) }}" method="Post">

                    @csrf

                        <div class="row">

                            <div class="col-md-4">
                                <input type="number" name="quantity" value="1" min="1" width=100px >
                            </div>

                            <div class="col-md-4">
                                <input type="submit" value="Add To Cart">
                            </div>

                        </div>
                    </form>
    </div>
        </div>

        {{-- End Body --}}

        <!-- Footer start -->
        @include('home.footer')
        <!-- Footer end -->

        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            </p>
        </div>

        <!-- jQuery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
        <!-- Popper.js -->
        <script src="home/js/popper.min.js"></script>
        <!-- Bootstrap.js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- Custom.js -->
        <script src="home/js/custom.js"></script>
    </body>

</html>
