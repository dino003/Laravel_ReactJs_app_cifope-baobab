<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionGenerale extends Model
{
    protected $table = 'session_generales';

    protected $fillable = [
        'code_systeme', 'nombre'
    ];
}
