<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClienteExport;

class excelController extends Controller
{
    //

    public function exportClientesExcel()
    {
        $cliente = Cliente::all();
        return Excel::download(new ClienteExport($cliente), 'Clientes ('.now()->format('d-m-Y').').xls');
    }
}
