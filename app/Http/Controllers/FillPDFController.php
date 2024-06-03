<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use App\Http\Controllers\Auth;

class FillPDFController extends Controller
{
    public function process(Request $request)
    {
        if (!auth()->check()) 
        {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        $nama = auth()->user()->name;
        // $nama = "MUHAMMAD HAIDAR TAQIYUDDIN";
        $outputfile = public_path().'dcc.pdf';
        $this->fillPDF(public_path().'/master/dcc.pdf', $outputfile, $nama);

        return response()->file($outputfile);
    }

    public function fillPDF($file,$outputfile,$nama)
    {
        $fpdi = new FPDI;
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);
        $top = 105;
        $right = 140;
        $name = $nama;
        $fpdi->setFont('helvetica', '', 20);
        $fpdi->setTextColor(25, 26, 25);
        $fpdi->Text($right, $top, $name);

        return $fpdi->Output($outputfile, 'F');
    }
}
