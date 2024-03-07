<?php

namespace App\Interfaces\Home\Payments;

interface PaymentRepositoryInterface
{
    public function processStripePayment($stripeToken, $totalPrice, $userId);
}

?>
