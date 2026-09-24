<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->invoice_token)) {
                $order->invoice_token = Str::random(10);
            }
        });
    }
}
