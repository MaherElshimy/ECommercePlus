<?php


namespace App\Interfaces\Admin\EmailAndPdf;

use Illuminate\Support\Collection;

interface AdminEmailRepositoryInterface
{
    public function sendEmail($orderId, Collection $details);
}
