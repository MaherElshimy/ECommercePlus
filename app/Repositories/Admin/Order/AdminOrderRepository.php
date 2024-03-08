<?php

namespace App\Repositories\Admin\Order;
use App\Models\Order;
use App\Interfaces\Admin\Order\AdminOrderRepositoryInterface;

class AdminOrderRepository implements AdminOrderRepositoryInterface
{
    public function getAllOrders()
    {
        return Order::all();
    }

    public function findOrderById($orderId)
    {
        return Order::find($orderId);
    }

    public function updateOrderStatus($orderId, $deliveryStatus, $paymentStatus)
    {
        $order = Order::find($orderId);
        $order->update(['delivery_status' => $deliveryStatus, 'payment_status' => $paymentStatus]);
    }

    public function searchOrders($searchText)
    {
        return Order::where('name', 'LIKE', "%$searchText")
            ->orWhere('phone', 'LIKE', "%$searchText")
            ->orWhere('product_title', 'LIKE', "%$searchText")
            ->get();
    }
}
