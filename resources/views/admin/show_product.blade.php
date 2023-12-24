<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        /* Additional styles for product content */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .product-table {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .product-table table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .product-table th, .product-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .product-table th {
            background-color: #3498db;
            color: #fff;
        }

        .product-actions {
            display: flex;
            justify-content: space-around;
        }

        .edit-btn, .delete-btn {
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            color: #fff;
        }

        .edit-btn {
            background-color: #2ecc71;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

    </style>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">


            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif



            <h2>Show Products</h2>

            <!-- Product Table -->
            <div class="product-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Image</th>
                            <th>Actions</th> <!-- Added column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop through products and display each row -->
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->catagory }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount_price }}</td>
                                <td><img src="{{ asset('product/' . $product->image) }}" alt="{{ $product->title }}" width="50"></td>
                                <td class="product-actions">
                                    <a class="edit-btn"href="{{ url('update_product', $product->id) }}">Edit</a>
                                    <a class="delete-btn" onclick="return confirm('Are You Sure To DELETE THIS')" href="{{ url('delete_product', $product->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
          <!-- Category Content -->

      <!-- container-scroller -->

      <!-- plugins:js -->
      @include('admin.script')
      <!-- End custom js for this page -->
    <!-- End custom js for this page -->
</div>

<!-- Add your JavaScript code for edit and delete actions here -->

</body>
</html>

