<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Product;
use Carbon\Carbon;



class AdminDashboardController extends Controller
{
    public function index()
    {
        // DAILY REVENUE (Last 24 hours)
        $dailyRevenue = Sale::where('created_at', '>=', now()->subDay())
            ->sum('subtotal');

        // Last 7 days revenue
        $last7Days = Sale::selectRaw('DATE(created_at) as date, SUM(subtotal) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        // MONTHLY SALES
        $thisMonth = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('subtotal');

        $lastMonth = Sale::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('subtotal');

        $monthlyGrowth = $lastMonth > 0 
            ? (($thisMonth - $lastMonth) / $lastMonth) * 100 
            : 0;

        // INVENTORY VALUE
        $inventoryValue = Product::sum(
            DB::raw('current_stock * selling_price')
        );

        $topProducts = Sale::selectRaw('product_id, SUM(quantity) as total_qty, SUM(subtotal) as total_revenue')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get()
            ->load('product');


        return view('admin.dashboard', compact(
            'dailyRevenue',
            'last7Days',
            'monthlyGrowth',
            'inventoryValue',
            'topProducts'
        ));
    }
}
