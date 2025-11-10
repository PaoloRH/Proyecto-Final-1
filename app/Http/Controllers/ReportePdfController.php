<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;

class ReportePdfController extends Controller
{
    public function clientes()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        $pdf = Pdf::loadView('pdf.reporte', compact('clientes'));

        return $pdf->stream('reporte-clientes.pdf');
    }
}
