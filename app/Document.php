<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  

     public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}
