<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $guarded = [];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_results')->withPivot('score');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
