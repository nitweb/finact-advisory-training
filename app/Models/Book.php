<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    public function getHasDiscountAttribute(): bool
    {
        return (int) $this->discount_percent > 0 && (int) $this->price > 0;
    }

    // Price after percentage discount (rounded to whole taka)
    public function getFinalPriceAttribute(): int
    {
        if (!$this->has_discount) {
            return (int) $this->price;
        }

        return (int) round($this->price * (100 - (int) $this->discount_percent) / 100);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'book_id', 'id');
    }
}
