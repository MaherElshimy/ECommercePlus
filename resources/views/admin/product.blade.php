<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        /* Additional styles for the "Add Product" heading */
        h2 {
            text-align: center;
            color: #fff; /* Set text color to white */
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            background-color: #333; /* Set background color */
            padding: 10px; /* Add padding for better visibility */
        }

        /* Additional styles for product content */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .product-form {
            margin: auto; /* Center horizontally */
            margin-top: 50px; /* Adjusted top margin */
            padding: 20px; /* Increased padding */
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: left;
            background-color: #fff;
            max-width: 400px; /* Reduced the form size */
        }

        .product-form label {
            display: block;
            margin-bottom: 10px; /* Increased margin */
            font-weight: bold;
            font-size: 14px;
        }

        .product-form input,
        .product-form select {
            margin-bottom: 15px; /* Increased margin */
            padding: 15px; /* Increased padding */
            width: 100%;
            color: #333; /* Set text color to black */
        }

        .product-form button {
            padding: 15px; /* Increased padding */
            background-color: #3498db; /* Set button background color */
            color: #fff; /* Set button text color to white */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .product-form button:hover {
            background-color: #2980b9; /* Change button background color on hover */
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')

    <!-- Product Content -->
    <div class="main-panel">
        <div class="content-wrapper">


            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif






            <h2>Add Product</h2>

            <!-- Add Product Form -->
            <div class="product-form">
                <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="title">Product Title:</label>
                    <input type="text" name="title" placeholder="Enter product title" required>

                    <label for="description">Product Description:</label>
                    <input type="text" name="description" placeholder="Enter product description" required>

                    <label for="image">Product Image:</label>
                    <input type="file" name="image" accept="image/*" required>

                    <label for="category">Product Category:</label>
                    <select name="catagory" required>
                        <option value="" selected disabled>Select Category</option>
                        @foreach($catagory as $catagory)
                        <option value="{{ $catagory->catagory_name }}">{{ $catagory->catagory_name }}</option>
                        @endforeach
                        <!-- Add more categories as needed -->
                    </select>

                    <label for="quantity">Product Quantity:</label>
                    <input type="text" name="quantity" placeholder="Enter product quantity" required>

                    <label for="price">Product Price:</label>
                    <input type="text" name="price" placeholder="Enter product price" required>

                    <label for="discount_price">Discount Price:</label>
                    <input type="text" name="discount_price" placeholder="Enter discount price">

                    <button type="submit">Add Product</button>
                </form>
            </div>

            <!-- Display Products Table -->
            <div class="product-container">
                <!-- Products will be dynamically added here -->
            </div>
        </div>
    </div>
    <!-- Product Content -->

    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</div>
</body>
</html>
