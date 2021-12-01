<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretenimiento extends Model
{
    use HasFactory;

    protected $fillable = ['iduser', 'idhobbie'];

    public function users()
    {
        return $this->belongsTo('App\Models\User','iduser','id');
    }

    public function hobbies()
    {
        return $this->belongsTo('App\Models\Hobbie','idhobbie','id');
    }
}
