<?php

namespace App\Http\Controllers\Home\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth ;


use App\Models\User ;
use App\Models\Product ;
use App\Models\Cart ;
use App\Models\Order ;

use App\Http\Controllers\Home\HomeController;


class OrderController extends Controller
{

    private $user;
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->orderRepository = $orderRepository;
    }

    /**
     * Show the user's order history.
     *
     * @return \Illuminate\View\View
     */
    public function showOrderHistory()
    {
        if ($this->user) {
            $userId = $this->user->id;
            $dataOrder = $this->orderRepository->getUserOrders($userId);
            return view('home.order', compact('dataOrder'));
        } else {
            return redirect('login');
        }
    }

    /**
     * Cancel an order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelOrder($id)
    {
        $this->orderRepository->cancelOrder($id);
        return redirect()->back();
    }
}
