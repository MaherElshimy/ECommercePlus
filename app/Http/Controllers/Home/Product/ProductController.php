<?php

namespace App\Http\Controllers\Home\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

use App\Interfaces\Home\Product\ProductRepositoryInterface;
use App\Interfaces\Home\Comment\CommentRepositoryInterface;
use App\Interfaces\Home\Comment\ReplyRepositoryInterface;

use App\Models\User ;
use App\Models\Product ;
use App\Models\Order ;
use App\Models\Comment ;
use App\Models\Reply ;



class ProductController extends Controller
{
    private $user;
    private $productRepository;
    private $commentRepository;
    private $replyRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CommentRepositoryInterface $commentRepository,
        ReplyRepositoryInterface $replyRepository
    ) {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
        $this->replyRepository = $replyRepository;
    }



    public function viewAllProducts()
    {
        $product = $this->productRepository->getAllProducts();
        $comment = $this->commentRepository->getAllComments();
        $reply = $this->replyRepository->getAllReplies();

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function productDetails($id)
    {
        $product = $this->productRepository->getProductDetails($id);

        return view('home.product_details', compact('product'));
    }


    public function productSearch(Request $request)
    {
        $searchText = $request->search;
        $comment = $this->commentRepository->getAllComments();
        $reply = $this->replyRepository->getAllReplies();
        $product = $this->productRepository->searchProducts($searchText);

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function products()
    {
        $product = $this->productRepository->getAllFeaturedProducts();
        $comment = $this->commentRepository->getAllComments();
        $reply = $this->replyRepository->getAllReplies();

        return view('home.all_product', compact('product', 'comment', 'reply'));
    }

    public function searchProduct(Request $request)
    {
        $searchText = $request->search;
        $comment = $this->commentRepository->getAllComments();
        $reply = $this->replyRepository->getAllReplies(); // Adjust accordingly
        $product = $this->productRepository->searchProducts($searchText);

        return view('home.all_product', compact('product', 'comment', 'reply'));
    }

}
