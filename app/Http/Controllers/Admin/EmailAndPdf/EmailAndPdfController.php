<?php

namespace App\Http\Controllers\Admin\EmailAndPdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Notifications\SendEmailNotification;

use App\Models\Order;
use PDF;
use Notification;


class EmailAndPdfController extends Controller
{

    private function checkAuthentication()
    {
        if (!Auth::id()) {
            return redirect('login');
        }
    }


    public function printPdf($orderId)
    {
        $this->checkAuthentication();

        $orderData = Order::find($orderId);
        $pdf = PDF::loadView('admin.pdf', compact('orderData'));

        return $pdf->download('order_details.pdf');
    }



    public function sendEmail($orderId)
    {
        $this->checkAuthentication();

        $order = Order::find($orderId);

        return view('admin.email_info', compact('order'));
    }



    public function sendUserEmail(Request $request, $orderId)
    {
        $this->checkAuthentication();

        $order = Order::find($orderId);
        $details = $request->only(['greeting', 'firstline', 'body', 'button', 'url', 'lastline']);

        Notification::send($order, new SendEmailNotification($details));

        return redirect()->back();
    }

}
