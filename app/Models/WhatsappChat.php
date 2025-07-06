<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappChat extends Model
{
    protected $guarded=[];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
