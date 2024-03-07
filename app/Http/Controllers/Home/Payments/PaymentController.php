<?php

namespace App\Http\Controllers\Home\Payments;


use App\Interfaces\Home\Payments\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth ;
use App\Models\User ;
use App\Models\Cart;

use Stripe;
use Session;

class PaymentController extends Controller
{
    private $user;
    private $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });

        $this->paymentRepository = $paymentRepository;
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
        $stripeToken = $request->stripeToken;
        $userId = $this->user->id;

        if ($this->paymentRepository->processStripePayment($stripeToken, $totalPrice, $userId)) {
            Session::flash('success', 'Payment successful!');
            return back();
        } else {
            Session::flash('error', 'Payment failed!');
            return back();
        }
    }
}
