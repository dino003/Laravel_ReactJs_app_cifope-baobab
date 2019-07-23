<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesdossier extends Model
{
    public function mesdocument(){
        return $this->hasMany(Mesdocument::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
