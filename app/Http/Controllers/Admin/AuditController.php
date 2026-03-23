<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with(['user']);

        // Filter by start date
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // Filter by end date
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search by product name or staff name
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('product_name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($sub) use ($request) {
                        $sub->where('name', 'like', '%' . $request->search . '%');
                });
            
            });
        }

        $logs = $query->latest()->paginate(15);

        return view('admin.audit.index', compact('logs'));
    }
}
