<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviens extends Model
{
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
