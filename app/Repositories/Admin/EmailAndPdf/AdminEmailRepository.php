<?php

namespace App\Repositories\Admin\EmailAndPdf;
use App\Interfaces\Admin\EmailAndPdf\AdminEmailRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Order;
use App\Notifications\SendEmailNotification;
use Notification;

class AdminEmailRepository implements AdminEmailRepositoryInterface
{
    public function sendEmail($orderId, Collection $details)
    {
        $order = Order::find($orderId);

        Notification::send($order, new SendEmailNotification($details->all()));
    }
}
