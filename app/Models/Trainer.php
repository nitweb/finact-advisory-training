<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $guarded = [];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_trainer', 'trainer_id', 'service_id');
    }
}
