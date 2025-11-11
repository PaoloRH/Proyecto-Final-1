<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;

class ReportePdfController extends Controller
{
    // 📄 Reporte general de todos los clientes
    public function clientes()
    {
        $clientes = Cliente::with('proyectos')->orderBy('nombre')->get();

        $pdf = Pdf::loadView('pdf.reporte', compact('clientes'));

        return $pdf->stream('reporte-clientes.pdf');
    }

    // 📄 Reporte individual de un cliente
    public function clienteIndividual($id)
    {
        $cliente = Cliente::with('proyectos')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.cliente_individual', compact('cliente'));

        return $pdf->stream("reporte-cliente-{$cliente->nombre}.pdf");
    }
}
