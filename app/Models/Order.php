<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id',
    'order_number',
    'amount',
    'status',
    'order_date',
];

protected $casts = [
    'order_date' => 'date',
    'amount' => 'decimal:2',
];

public function customer()
{
    return $this->belongsTo(Customer::class);
}

protected static function boot()
{
    parent::boot();

    static::creating(function ($order) {
        if (empty($order->order_number)) {
            $order->order_number = 'ORD-' . strtoupper(uniqid());
        }
    });
}
}