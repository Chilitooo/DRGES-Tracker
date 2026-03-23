<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;
use App\Models\AuditLog;
use Exception;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product', 'user')->get();
        return view('staff.sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('staff.sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validation (always important)
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,gcash,paymaya',
            'reference_number' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($request->payment_method !== 'cash' && empty($request->reference_number)) {
            return redirect()->back()->with('error', 'Reference number is required for non-cash payments.');
        }

        try {
            DB::transaction(function () use ($request) {

                // Lock product row to prevent double selling
                $product = Product::lockForUpdate()->findOrFail($request->product_id);

                // Prevent selling if stock is insufficient
                if ($product->current_stock < $request->quantity) {
                    throw new \Exception("Insufficient stock");
                }

                // Calculate totals properly (considering discount if needed)
                $unitPrice = $product->selling_price;
                $subtotal = $unitPrice * $request->quantity;
                $discountPercent = $request->discount ?? 0;
                $discountAmount = $subtotal * ($discountPercent / 100);
                $finalTotal = $subtotal - $discountAmount; 

                // create sale and store in variable
                $sale = Sale::create([
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $finalTotal,
                    'discount' => $discountAmount,
                    'payment_method' => $request->payment_method,
                    'reference_number' => $request->payment_method !== 'cash' ? $request->reference_number : null,
                    'user_id' => auth()->id(),
                ]);

                // reduce stock
                $product->decrement('current_stock', $request->quantity);

                // Audit log here
                AuditLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'sale',
                    'reference_id' => $sale->id,
                    'product_name' => $product->name,
                    'quantity' => $request->quantity,
                    'amount' => $finalTotal,
                ]);
            });

            return redirect()->route('staff.sales.index')->with('success', 'Sale recorded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $sale = Sale::with('product', 'user')->findOrFail($id);
        return view('staff.sales.show', compact('sale'));
    }

    public function zRead()
    {
        $today = now()->toDateString();
        $sales = Sale::whereDate('created_at', $today)->where('user_id', auth()->id())->get();
        return view('staff.sales.zread', compact('sales'));
    }
}
