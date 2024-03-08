<?php

namespace App\Repositories\Admin\EmailAndPdf;

use App\Interfaces\Admin\EmailAndPdf\AdminPdfRepositoryInterface;
use App\Models\Order;
use PDF;

class AdminPdfRepository implements AdminPdfRepositoryInterface
{
    public function generatePdf($orderId)
    {
        $orderData = Order::find($orderId);
        $pdf = PDF::loadView('admin.pdf', compact('orderData'));

        return $pdf->download('order_details.pdf');
    }
}

?>
