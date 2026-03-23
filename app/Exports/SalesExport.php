<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sale::with('product', 'user')->get()->map(function($sale) {
            return [
                'Sale ID' => $sale->id,
                'Product' => optional($sale->product)->name,
                'Staff' => optional($sale->user)->name,
                'Unit Price' => $sale->unit_price,
                'Quantity' => $sale->quantity,
                'Subtotal' => $sale->subtotal,
                'Discount' => $sale->discount,
                'Payment Method' => $sale->payment_method,
                'Reference' => $sale->reference_number,
                'Date Sold' => $sale->created_at->timezone('Asia/Manila')->format('m-d-Y h:i A'),
            ];
        });
    }
}
