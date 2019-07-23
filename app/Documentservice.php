<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentservice extends Model
{
      public function user()
    {
        return $this->belongsTo(User::class);
    }
        public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

     public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}
