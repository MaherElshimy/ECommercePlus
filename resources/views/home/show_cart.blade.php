<!DOCTYPE html>
<html lang="en">
<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            margin-top: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff; /* Added background color for better readability */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .img_deg {
            max-height: 75px;
            max-width: 75px;
            border-radius: 5px;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .total-price {
            margin-top: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;


        }
    </style>
</head>
<body>

    @include('sweetalert::alert')

    <div class="hero_area">
        <!-- Header section starts -->
        @include('home.header');
        <!-- End header section -->



    @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
        </div>
    @endif


    <div class="container">
        <h2 style="text-align:center">Shopping Cart</h2>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalPrice = 0; ?>
                <!-- Loop through cart items and display each row -->
                @foreach($carts as $cart)
                    <tr>
                        <td>{{ $cart->product_title }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>${{ $cart->price }}</td>
                        <td><img class="img_deg" src="/product/{{ $cart->image }}" alt="Product Image"></td>
                        {{-- <td><a class="btn btn-danger" onclick="return confirm('Are You Sure Remove This Product ?')" href="{{ url('/remove_cart',$cart->id) }}"> Remove Cart </a></td> --}}
                        <td><a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('/remove_cart',$cart->id) }}"> Remove Cart </a></td>
                    </tr>
                    <?php $totalPrice += $cart->price; ?>
                @endforeach
            </tbody>
        </table>

        <div class="total-price">
            <h1>Total Price: ${{ $totalPrice }}</h1>
        </div>

        <div class="total-price">
            <h1 style="font-size:25px; padding-bottom:15px">Proceed To Order</h1>
            <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash On Delivery</a>
            <a href="{{ url('stripe',$totalPrice) }}" class="btn btn-danger">Pay Using Card</a>
        </div>

    </div>

    <!-- Footer start -->
    @include('home.footer');
    <!-- Footer end -->

    <div class="cpy_">
        <p class="mx-auto">
            © 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
    </div>







    <script>

        function confirmation(ev) {
          ev.preventDefault();
          var urlToRedirect = ev.currentTarget.getAttribute('href');
          console.log(urlToRedirect);
          swal({
              title: "Are you sure to cancel this product",
              text: "You will not be able to revert this!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willCancel) => {
              if (willCancel) {



                  window.location.href = urlToRedirect;

              }


          });


      }
  </script>



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
