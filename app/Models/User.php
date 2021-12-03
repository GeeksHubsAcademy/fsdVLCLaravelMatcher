<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    

    //
    protected $fillable = [
        'email', 'name', 'password', 'gender', 'orientation', 'status', 'intention', 'age', 
        'surname'
    ];

    protected $hidden = ['password'];

    use HasApiTokens, HasFactory, Notifiable;

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
