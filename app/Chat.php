<?php

namespace App;

use App\Traits\Boutique;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use Boutique;

    protected $fillable = [
        'emmeteur_id', 'receveur_id', 'message'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'emmeteur_id');
    }


}
