<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $guarded = [];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id');
    }
}
