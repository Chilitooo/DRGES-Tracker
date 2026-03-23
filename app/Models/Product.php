<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'name', 'category', 'unit', 'selling_price', 'safety_stock'
    ];

    protected $appends = ['current_stock'];

    // <-- Paste the code below inside the class
    public function stockIns(){
        return $this->hasMany(StockIn::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function getCurrentStockAttribute(){
        $totalStockIn = $this->stockIns()->sum('quantity') ?? 0;
        $totalSales = $this->sales()->sum('quantity') ?? 0;
        
        return ($this->initial_stock ?? 0) + $totalStockIn - $totalSales;
    }
}
