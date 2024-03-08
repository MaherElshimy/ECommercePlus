<?php

namespace App\Http\Controllers\Admin\EmailAndPdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Admin\EmailAndPdf\AdminPdfRepositoryInterface;
use App\Interfaces\Admin\EmailAndPdf\AdminEmailRepositoryInterface;
use App\Interfaces\Admin\Order\AdminOrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Order;

class EmailAndPdfController extends Controller
{
    private $pdfRepository;
    private $emailRepository;
    private $orderRepository;

    public function __construct(
        AdminPdfRepositoryInterface $pdfRepository,
        AdminEmailRepositoryInterface $emailRepository,
        AdminOrderRepositoryInterface $orderRepository
    ) {
        $this->middleware(function ($request, $next) {
            if (!Auth::id()) {
                return redirect('login');
            }
            return $next($request);
        });

        $this->pdfRepository = $pdfRepository;
        $this->emailRepository = $emailRepository;
        $this->orderRepository = $orderRepository;
    }

    public function printPdf($orderId)
    {
        return $this->pdfRepository->generatePdf($orderId);
    }

    public function sendEmail($orderId)
    {
        $order = $this->orderRepository->findOrderById($orderId);
        return view('admin.email_info', compact('order'));
    }

    public function sendUserEmail(Request $request, $orderId)
    {
        $details = new Collection($request->only(['greeting', 'firstline', 'body', 'button', 'url', 'lastline']));
        $this->emailRepository->sendEmail($orderId, $details);
        return redirect()->back()->with('message', 'Email sent successfully');

    }
}
