<?php

namespace App\Http\Controllers\Home\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Interfaces\Home\Product\ProductRepositoryInterface;

use App\Models\User ;
use App\Models\Product ;
use App\Models\Order ;
use App\Models\Comment ;
use App\Models\Reply ;



class ProductController extends Controller
{
    private $user;
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->productRepository = $productRepository;
    }



     /**
     * Show the home page for users.
     *
     * @return \Illuminate\View\View
     */

     public function viewAllProducts()
     {
         $product = $this->productRepository->getAllProducts();
         $comment = Comment::orderBy('id', 'desc')->get();
         $reply = Reply::all();

         return view('home.userpage', compact('product', 'comment', 'reply'));
     }

    /**
     * Display details of a product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

     public function productDetails($id)
     {
         $product = $this->productRepository->getProductDetails($id);

         return view('home.product_details', compact('product'));
     }



     public function productSearch(Request $request)
     {
         $searchText = $request->search;
         $comment = Comment::orderBy('id', 'desc')->get();
         $reply = Reply::all();
         $product = $this->productRepository->searchProducts($searchText);

         return view('home.userpage', compact('product', 'comment', 'reply'));
     }



     public function products()
     {
         $product = $this->productRepository->getAllFeaturedProducts();
         $comment = Comment::orderBy('id', 'desc')->get();
         $reply = Reply::all();

         return view('home.all_product', compact('product', 'comment', 'reply'));
     }

     public function searchProduct(Request $request)
     {
         $searchText = $request->search;
         $comment = Comment::orderBy('id', 'desc')->get();
         $reply = Reply::all();
         $product = $this->productRepository->searchProducts($searchText);

         return view('home.all_product', compact('product', 'comment', 'reply'));
     }


}
