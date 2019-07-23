<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'titre', 'contenu', 'image', 'fichier', 'lien', 'nomFichier', 'user_id', 'date_publication'
    ];

    protected $dates = ['date_publication'];

    public function structures()
    {
        return $this->belongsToMany(Structure::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

}
