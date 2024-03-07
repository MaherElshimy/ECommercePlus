<?php

namespace App\Http\Controllers\Home\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth ;
use App\Models\User ;
use Stripe;

class PaymentController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display the Stripe payment page.
     *
     * @param  int  $totalPrice
     * @return \Illuminate\View\View
     */
    public function showStripePaymentPage($totalPrice)
    {
        return view('home.stripe', compact('totalPrice'));
    }

        /**
     * Process a Stripe payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $totalPrice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processStripePayment(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks For Payment."
        ]);

        $userId = $this->user->id;
        $carts = Cart::where('user_id', '=', $userId)->get();

        foreach ($carts as $cart) {
            $this->createOrder($cart, 'Paid');
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');
        return back();
    }



}
