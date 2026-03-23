<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product','user')->latest()->get();
        $totalRevenue = Sale::sum('subtotal');

        return view('admin.reports.index', compact('sales','totalRevenue'));
    }

    public function export()
    {
        return Excel::download(new SalesExport, 'sales_report.xlsx');
    }
}
