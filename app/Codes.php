<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codes extends Model
{
    protected $table = 'codes_acces_pour_utilisateurs';

    protected $fillable = [
        'code', 'nombre_utilisateurs'
    ];
}
