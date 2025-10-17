<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReconciliationExport;
use Maatwebsite\Excel\Facades\Excel;

class ReconciliationController extends Controller
{
    public function export()
    {
        return Excel::download(new ReconciliationExport, 'reconciliation.xlsx');
    }
}
