<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }
}
