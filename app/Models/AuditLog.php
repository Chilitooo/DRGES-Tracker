<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'reference_id',
        'product_name',
        'quantity',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
