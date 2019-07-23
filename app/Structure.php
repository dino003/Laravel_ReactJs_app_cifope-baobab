<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

   public function structure_mere()
    {
        return $this->belongsTo(Structure::class);
    }

    public function structure_fille(){
        return $this->hasMany(Structure::class);
    }

    public function dossier(){
        return $this->hasMany(Dossier::class);
    }

    public function intervien(){
        return $this->hasMany(Interviens::class);
    }

    public function documentservice(){
        return $this->hasMany(Documentservice::class);
    }

    public function mediatheque(){
        return $this->hasMany(Mediatheque::class);
    }

    public function lien(){
        return $this->hasMany(Lien::class);
    }
}
