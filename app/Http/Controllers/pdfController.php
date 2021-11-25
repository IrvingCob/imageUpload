<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use PDF;

class pdfController extends Controller
{
    //

    public function cliente(){

        $cliente = Cliente::all();

        $pdf = PDF::loadView('PDF/cliente', ['cliente' => $cliente]); //Aqui se hace la inyección de la variable
        
        return $pdf->stream('cliente.pdf', compact('cliente'));
    }
}
