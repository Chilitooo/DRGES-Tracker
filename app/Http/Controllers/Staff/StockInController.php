<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\AuditLog;
use Exception;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with('product', 'user')->get();
        return view('staff.stock-in.index', compact('stockIns'));
    }

    public function create()
    {
        $products = Product::all();
        return view('staff.stock-in.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'batch_number' => 'nullable|string',
            'expiry_date' => 'nullable|date',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::findOrFail($request->product_id);

                // stock in and store in variable
                $stockIn = StockIn::create([
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'batch_number' => $request->batch_number,
                    'expiry_date' => $request->expiry_date,
                    'user_id' => auth()->id(),
                ]);



                // Update product stock
                $product->increment('current_stock', $request->quantity);

                // Audit log
                AuditLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'stock_in',
                    'reference_id' => $stockIn->id,
                    'product_name' => $product->name,
                    'quantity' => $stockIn->quantity,
                    'amount' => null, // No amount for stock in
                ]);
            });

            return redirect()->route('staff.stock-in.index')->with('success', 'Stock in recorded successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Operation failed: ' . $e->getMessage());
        }
    }

        public function show($id)
        {
            $stockIn = StockIn::with('product', 'user')->findOrFail($id);
            return view('staff.stock-in.show', compact('stockIn'));
        }
}
