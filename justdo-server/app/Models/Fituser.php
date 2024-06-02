<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


class Fituser extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    
    protected $primaryKey = 'fituser_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'password',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'fituser_exercise', 'fituser_id', 'exercise_id')
            ->withPivot('reps');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
