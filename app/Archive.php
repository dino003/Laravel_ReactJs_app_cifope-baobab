<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = [
        'operation', 'auteur', 'heure', 'laDate', 'service', 'document', 'date_formatee'
    ];
}
