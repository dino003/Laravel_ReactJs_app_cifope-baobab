<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesdocument extends Model
{
    public function mesdossier()
    {
        return $this->belongsTo(Mesdossier::class);
    }
}
