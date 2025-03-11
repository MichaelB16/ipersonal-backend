<?php

namespace App\Services\pdf;

use App\Contracts\PdfInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class DietPdfService implements PdfInterface
{
    public function generatePdf(array $data)
    {
        return Pdf::loadView('pdf.diet', $data)->output();
    }
}
