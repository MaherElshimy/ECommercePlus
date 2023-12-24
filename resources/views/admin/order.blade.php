<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }

        .order-table th {
            background-color: #3498db;
            color: #fff;
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
            <h1 class="title_deg">All Orders</h1>



            <div style="padding-left:400px; padding-buttom:30px ;">
                <form action="{{ url('search') }}" method="get">
                    @csrf
                    <input style="color : black;" type="text" name="search" placeholder="Search For Something">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div>
            <!-- Display orders in a table -->
            <table class="order-table">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Delivered</th>
                        <th>Printd PDF</th>
                        <th>Send Email</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through orders and display each row -->
                    @forelse($order as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->product_title }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                            <td><img src="/product/{{ $order->image }}" alt="Product Image" style="max-width: 50px;"></td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->delivery_status }}</td>


                            <td>
                                @if($order->delivery_status =='processing')
                                <a href="{{ url('delivered',$order->id) }}" onclick="return confirm('Are You Sure this product is delivered !!!')" class="btn btn-primary">Delivered</a>

                                @else
                                <p>Delivered</p>
                                @endif
                            </td>

                            <td>
                                <a href="{{ url('print_pdf',$order->id) }}" class="btn btn-secondary">Print PDF</a>
                            </td>

                            <td>
                                <a href="{{ url('send_email', $order->id) }}" class="btn btn-info">Send Email</a>
                            </td>
                        </tr>

                        @empty
                        <tr >
                            <td colspan="16">No Data Found</td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
      </div>

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
