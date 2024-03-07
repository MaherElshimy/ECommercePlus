<?php

namespace App\Repositories\Home\Order;
use App\Interfaces\Home\Order\OrderRepositoryInterface;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function create($data)
    {
        return Order::create($data);
    }

    public function getUserOrders($userId)
    {
        return Order::where('user_id', $userId)->get();
    }

    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);
        $order->delivery_status = "You Canceled the order";
        $order->save();
    }


}


?>
