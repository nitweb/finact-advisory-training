<?php
// app/Models/Training.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $guarded = [];

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'training_trainer', 'training_id', 'trainer_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'training_id', 'id');
    }
}
