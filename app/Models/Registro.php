<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'data_hora',
        'localizacao',
       'reg_id',
        'user_id',
    ];
}
