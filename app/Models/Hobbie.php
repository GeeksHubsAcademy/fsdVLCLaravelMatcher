<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion','idhobbie'
    ];

    public function entrenimientos()
    {
        return $this->hasMany('App\Models\Entretenimiento','idhobbie','id');
    }
}
