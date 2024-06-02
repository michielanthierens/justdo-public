<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise_language extends Model
{
    use HasFactory;
    protected $table = 'exercises_language';
    protected $primaryKey = 'exercise_language_id';
    public $timestamps = false;
    protected $fillable = [
        'exercise_id',
        'language_code',
        'exercise',
        'description',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'exercise_id');
    }
}
