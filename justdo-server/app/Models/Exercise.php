<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $primaryKey = 'exercise_id';
    public $timestamps = false;
    
    protected $fillable = [
        'difficulty'
    ];

    public function translations()
    {
        return $this->hasMany(Exercise_language::class, 'exercise_id', 'exercise_id');
    }

    public function fitusers()
    {
        return $this->belongsToMany(Fituser::class, 'fituser_exercise', 'exercise_id', 'fituser_id')
            ->withPivot('reps');
    }
}
