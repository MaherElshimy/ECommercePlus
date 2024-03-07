<?php

namespace App\Repositories\Home\Payments;

use App\Interfaces\Home\Payments\PaymentRepositoryInterface;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Cart;
use App\Models\Order;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function processStripePayment($stripeToken, $totalPrice, $userId)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $stripeToken,
            "description" => "Thanks For Payment."
        ]);

        $carts = Cart::where('user_id', $userId)->get();

        foreach ($carts as $cart) {
            $this->createOrder($cart, 'Paid');
            $cart->delete();
        }

        return true;
    }

    private function createOrder($cart, $paymentStatus)
    {
        $order = new Order;
        $order->fill([
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
        ])->save();
    }
}


?>
