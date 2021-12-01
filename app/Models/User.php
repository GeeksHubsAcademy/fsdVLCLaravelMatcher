<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    //
    protected $fillable = [
        'email', 'name', 'password', 'gender', 'orientation', 'status', 'intention', 'age', 
        'surname'
    ];

    protected $hidden = ['password'];

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function profiles()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function entretenimientos()
    {
        return $this->hasMany('App\Models\Entretenimiento', 'iduser');
    }
}
