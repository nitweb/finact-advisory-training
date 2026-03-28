<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetails::class, 'service_category_id');
    }
}
