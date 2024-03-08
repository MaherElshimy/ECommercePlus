<?php

namespace App\Interfaces\Admin\Order;
use App\Models\Order;

interface AdminOrderRepositoryInterface
{
    public function getAllOrders();

    public function findOrderById($orderId);

    public function updateOrderStatus($orderId, $deliveryStatus, $paymentStatus);

    public function searchOrders($searchText);
}

?>
