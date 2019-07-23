<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
      public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

     public function dossier_mere()
    {
        return $this->belongsTo(Structure::class);
    }

    public function dossier_fille(){
        return $this->hasMany(Structure::class);
    }

     public function documentservice(){
        return $this->hasMany(Documentservice::class);
    }
}
