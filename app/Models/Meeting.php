<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded=[];

    public function users()
    {
        return $this->belongsTo(User::class, "assing_to", "id");
    }

    public function templates(){
        return $this->belongsTo(Template::class, "meeting_template", "id");
    }
}
