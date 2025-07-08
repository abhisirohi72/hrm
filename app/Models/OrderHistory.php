<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderHistory extends Model
{
    protected $guarded=[];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id','product_id');
    }

    public function single_products(): HasOne
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }

    public function users():HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
