<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Models\Product;
use App\Models\Order;

class OrderAdminController extends Controller
{
    private function checkAuthentication()
    {
        if (!Auth::id()) {
            return redirect('login');
        }
    }



    public function order()
    {
        $this->checkAuthentication();

        $orders = Order::all();

        return view('admin.order', compact('orders'));
    }



    public function delivered($orderId)
    {
        $this->checkAuthentication();

        $order = Order::find($orderId);
        $order->update(['delivery_status' => 'delivered', 'payment_status' => 'Paid']);

        return redirect()->back();
    }


    public function searchData(Request $request)
    {
        $this->checkAuthentication();

        $searchText = $request->search;
        $orders = Order::where('name', 'LIKE', "%$searchText")->orWhere('phone', 'LIKE', "%$searchText")
            ->orWhere('product_title', 'LIKE', "%$searchText")->get();

        return view('admin.order', compact('orders'));
    }

}
