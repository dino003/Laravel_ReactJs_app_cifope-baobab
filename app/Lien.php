<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lien extends Model
{
     public function Structure()
    {
        return $this->belongsTo(Structure::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
