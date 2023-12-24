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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .hero_area {
            padding: 20px;
        }

        table {
            width: 100%;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 15px;
            text-align: center;
        }

        th {
            font-weight: bold;
            font-size: 1.2em;
            background-color: #007bff;
            color: #ffffff;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .cpy_ {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .not-allowed-message {
        background-color: #f8d7da; /* Light red background */
        color: #721c24; /* Dark red text color */
        padding: 8px; /* Padding around the message */
        border-radius: 4px; /* Rounded corners */
        text-align: center; /* Center the text */
        font-weight: bold; /* Bold text */
    }

    </style>
</head>
<body>
    <div class="hero_area">
        @include('home.header');

        <div>
            <table class="table table-bordered table-hover">
                <!-- Table headers -->
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Cancel Order</th>
                    </tr>
                </thead>
                <!-- Table data -->
                <tbody>
                    @foreach ($data_order as $data_order)
                    <tr>
                        <td class="align-middle">{{ $data_order->product_title }}</td>
                        <td class="align-middle">{{ $data_order->quantity }}</td>
                        <td class="align-middle">{{ $data_order->price }}</td>
                        <td class="align-middle">{{ $data_order->payment_status }}</td>
                        <td class="align-middle">{{ $data_order->delivery_status }}</td>
                        <td class="align-middle">
                            <img src="/product/{{ $data_order->image }}" alt="Product Image" style="width: 150px; height: 100px;">
                        </td>

                        <td class="align-middle">
                            @if($data_order->delivery_status=='processing')
                                <a onclick="return confirm('Are You Sure to cancel this order !!!')" class="btn btn-danger" href="{{ url('cancel_order',$data_order->id) }}">Cancel Order</a>
                            @else
                                <div class="not-allowed-message">
                                    <p>Not Allowed</p>
                                </div>
                            @endif
                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="cpy_">
        <p class="mx-auto">
            © 2021 All Rights Reserved By <a href="https://html.design/" style="color: #ffffff;">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank" style="color: #ffffff;">ThemeWagon</a>
        </p>
    </div>
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <script src="home/js/popper.min.js"></script>
    <script src="home/js/bootstrap.js"></script>
    <script src="home/js/custom.js"></script>
</body>
</html>
