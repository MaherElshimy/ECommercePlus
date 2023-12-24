<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        /* Additional styles for category content */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .category-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .category {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 50px;
            width: 900px; /* Increase the width as needed */
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .add-category-form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            background-color: #fff;
        }

        .add-category-form input {
            margin-bottom: 10px;
            padding: 10px;
            width: 80%;
            color: #333; /* Set text color to black */
        }

        .add-category-form button {
            padding: 10px;
            background-color: #3498db; /* Set button background color */
            color: #fff; /* Set button text color to white */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-category-form button:hover {
            background-color: #2980b9; /* Change button background color on hover */
        }

        .delete-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')

      <!-- Category Content -->
      <div class="main-panel">
          <div class="content-wrapper">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif

              <h2>Category Management</h2>

              <!-- Add Category Form -->
              <div class="add-category-form">
                  <form action="{{ url('/add_catagory') }}" method="POST" >
                    @csrf
                      <input type="text" name="categoryName" placeholder="Enter category name" required>
                      <input type="submit" value = "Add Catagory">
                  </form>
              </div>

              <!-- Display Categories Table -->
              <div class="category-container">
                <table class="category">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dummy data for illustration -->

                        @foreach($data as $data)
                        <tr class="category">
                            <td> {{ $data->catagory_name }}</td>
                            <td>

                                <a onclick="return confirm('Are You Sure To Delete This')" class="delete-btn" href="{{ url ('delete_catagory' , $data->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach



                        <!-- Add more dummy data as needed -->
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
    </div>
  </body>
</html>
