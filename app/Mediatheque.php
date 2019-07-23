<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mediatheque extends Model
{
   public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
