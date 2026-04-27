<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $guarded = [];

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_trainer', 'trainer_id', 'training_id');
    }
}
