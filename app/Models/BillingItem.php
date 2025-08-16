<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingItem extends Model
{
    protected $fillable = [
        'billing_id',
        'description',
        'quantity',
        'unit_price',
        'line_total'
    ];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
}
