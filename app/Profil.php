<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    public function __construct()
    {

        setlocale(LC_TIME, 'French');
    }

    protected $fillable = [
        'civilite', 'fonction', 'user_id', 'nom_organisme', 'numeroTelephone', 'naissance', 'pays', 'telecopie', 'adresse', 'matricule'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maDateSimple($var)
    {
       
           // $date = $this->naissance->format('%A %d %B %Y');

            $date = date('d-m-Y', strtotime($var));
        

        return $date;
    }
}
