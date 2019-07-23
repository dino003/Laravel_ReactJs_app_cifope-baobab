<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Messagerie extends Model
{
    protected $fillable = [
        'message', 'from_id', 'to_id', 'read_at'
    ];

    protected $dates = ['read_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
