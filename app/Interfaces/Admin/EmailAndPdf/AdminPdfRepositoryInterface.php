<?php
namespace App\Interfaces\Admin\EmailAndPdf;

interface AdminPdfRepositoryInterface
{
    public function generatePdf($orderId);
}



?>
