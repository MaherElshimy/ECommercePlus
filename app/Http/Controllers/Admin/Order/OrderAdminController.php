<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Models\Product;
use App\Models\Order;
use App\Interfaces\Admin\Order\AdminOrderRepositoryInterface;

class OrderAdminController extends Controller
{
    private $orderRepository;

    public function __construct(AdminOrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    private function checkAuthentication()
    {
        if (!auth()->check()) {
            return redirect('login');
        }
    }

    public function order()
    {
        $this->checkAuthentication();

        $orders = $this->orderRepository->getAllOrders();

        return view('admin.order', compact('orders'));
    }

    public function delivered($orderId)
    {
        $this->checkAuthentication();

        $this->orderRepository->updateOrderStatus($orderId, 'delivered', 'Paid');

        return redirect()->back();
    }

    public function searchData(Request $request)
    {
        $this->checkAuthentication();

        $searchText = $request->search;
        $orders = $this->orderRepository->searchOrders($searchText);

        return view('admin.order', compact('orders'));
    }
}
?>
