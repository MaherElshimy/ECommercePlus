{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your E-commerce Store</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f8f8;
                color: #333;
            }

            header {
                background-color: #3498db;
                color: #fff;
                text-align: center;
                padding: 1em;
            }

            nav {
                background-color: #2980b9;
                color: #fff;
                text-align: center;
                padding: 1em;
            }

            nav a {
                color: #fff;
                text-decoration: none;
                padding: 1em;
                margin: 0 1em;
            }

            section {
                margin: 2em;
            }

            footer {
                background-color: #3498db;
                color: #fff;
                text-align: center;
                padding: 1em;
            }

            .product {
                border: 1px solid #ddd;
                padding: 1em;
                margin: 1em;
                text-align: center;
                background-color: #fff;
            }

            .product img {
                max-width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Your E-commerce Store</h1>
        </header>

        <nav>
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">Cart</a>
            <a href="#">Contact</a>
        </nav>

        <section>
            <div class="product">
                <img src="images/product1.jpg" alt="Product 1">
                <h2>Product 1</h2>
                <p>Description of Product 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <button>Add to Cart</button>
            </div>

            <div class="product">
                <img src="product2.jpg" alt="Product 2">
                <h2>Product 2</h2>
                <p>Description of Product 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <button>Add to Cart</button>
            </div>
            <!-- Add more product divs as needed -->
        </section>

        <footer>
            <p>&copy; 2023 Your E-commerce Store</p>
        </footer>
    </body>
    </html>

</x-app-layout>
