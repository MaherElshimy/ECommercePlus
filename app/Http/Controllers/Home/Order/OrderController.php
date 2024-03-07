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

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }


    /**
     * Show the user's order history.
     *
     * @return \Illuminate\View\View
     */
    public function showOrderHistory()
    {
        if ($this->user) {
            $user_id = $this->user->id;
            $data_order = Order::where('user_id', '=', $user_id)->get();
            return view('home.order', compact('data_order'));
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
        $order = Order::find($id);
        $order->delivery_status = "You Canceled the order";
        $order->save();
        return redirect()->back();
    }

}
