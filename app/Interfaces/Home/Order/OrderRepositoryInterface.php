<?php
// app/Interfaces/OrderRepositoryInterface.php

namespace App\Interfaces\Home\Order;

interface OrderRepositoryInterface
{
    public function create($data);
    public function getUserOrders($userId);
    public function cancelOrder($orderId);

}


?>
