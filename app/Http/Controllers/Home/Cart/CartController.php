<?php

namespace App\Http\Controllers\Home\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\OrderController;
use App\Interfaces\Home\Cart\CartRepositoryInterface;
use App\Interfaces\Home\Order\OrderRepositoryInterface;

use Illuminate\Support\Facades\Auth ;


use App\Models\User ;
use App\Models\Product ;
use App\Models\Cart ;
use App\Models\Order ;

use Session;
use Stripe;

use RealRashid\SweetAlert\Facades\Alert;



class CartController extends Controller
{

    private $user;
    private $cartRepository;
    private $orderRepository;

    public function __construct(CartRepositoryInterface $cartRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Create an order.
     *
     * @param  \App\Models\Cart  $cart
     * @param  string  $paymentStatus
     * @return void
     */
    private function createOrder($cart, $paymentStatus)
    {
        $orderData = [
            'name' => $cart->name,
            'email' => $cart->email,
            'phone' => $cart->phone,
            'address' => $cart->address,
            'user_id' => $cart->user_id,
            'product_title' => $cart->product_title,
            'price' => $cart->price,
            'quantity' => $cart->quantity,
            'image' => $cart->image,
            'product_id' => $cart->product_id,
            'payment_status' => $paymentStatus,
            'delivery_status' => 'processing',
        ];

        $this->orderRepository->create($orderData);
    }
/**
 * Add a product to the shopping cart.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function addCart(Request $request, $id)
{
    if ($this->user) {
        $product = Product::find($id);
        $userId = $this->user->id;
        $productExistId = $this->cartRepository->findCartByProductIdAndUserId($id, $userId);

        if ($productExistId) {
            $cart = $this->cartRepository->find($productExistId);
            $quantity = $cart->quantity;
            $cart->quantity = $quantity + $request->quantity;

            $cart->price = ($product->discount_price != null)
                ? $product->discount_price * $cart->quantity
                : $product->price * $cart->quantity;

            $this->cartRepository->save($cart);
            Alert::success('Product Added Successfully', 'We have added the product to the cart');
        } else {
            $cartData = [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
                'address' => $this->user->address,
                'user_id' => $this->user->id,
                'product_title' => $product->title,
                'price' => ($product->discount_price != null)
                    ? $product->discount_price * $request->quantity
                    : $product->price * $request->quantity,
                'image' => $product->image,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ];

            $this->cartRepository->create($cartData);
            Alert::success('Product Added Successfully', 'We have added the product to the cart');
        }

        return redirect()->back();
    } else {
        return redirect()->route('login');
    }
}


    /**
     * Show the shopping cart.
     *
     * @return \Illuminate\View\View
     */
    public function showCart()
    {
        if ($this->user) {
            $carts = Cart::where('user_id', '=', $this->user->id)->get();
            return view('home.show_cart', compact('carts'));
        } else {
            return redirect('login');
        }
    }



    /**
     * Remove an item from the shopping cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

     public function removeCart($id)
     {
         $this->cartRepository->find($id)->delete();
         return redirect()->back();
     }


    /**
     * Process a cash order.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processCashOrder()
    {
        $userId = $this->user->id;
        $carts = Cart::where('user_id', '=', $userId)->get();

        foreach ($carts as $cart) {
            $this->createOrder($cart, 'cash on delivery');
            $this->cartRepository->find($cart->id)->delete();
        }

        return redirect()->back()->with('message', 'We have Received Your Order. We will connect with you Soon....');
    }


}
