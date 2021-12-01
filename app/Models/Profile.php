<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion', 'paypal','foto', 'paid', 'nick','iduser'];

    public function usuario()
    {
     return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }
}
