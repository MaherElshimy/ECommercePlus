<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .order-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        h1, h3 {
            text-align: center;
            color: #007bff;
        }

        .product-image {
            max-height: 100px;
            max-width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>

        <div class="order-details">
            <h3>Customer name : {{ $order_data->name }}</h3>
            <p>Customer Email: {{ $order_data->email }}</p>
            <p>Customer Phone: {{ $order_data->phone }}</p>
            <p>Customer Address: {{ $order_data->address }}</p>
            <p>Customer ID: {{ $order_data->user_id }}</p>

            <hr>

            <h4>Product Information</h4>
            <p>Product Name: {{ $order_data->product_title }}</p>
            <p>Product Quantity: {{ $order_data->quantity }}</p>
            <p>Product Price: ${{ $order_data->price }}</p>
            <p>Product Image: <img class="product-image" src="{{ public_path('product/' . $order_data->image) }}" alt="Product Image"></p>
            <p>Product ID: {{ $order_data->product_id }}</p>

            <hr>

            <h4>Order Status</h4>
            <p>Payment Status: {{ $order_data->payment_status }}</p>
            <p>Delivery Status: {{ $order_data->delivery_status }}</p>
        </div>
    </div>
</body>
</html>
