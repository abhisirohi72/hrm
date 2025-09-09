<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'description',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'status',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'discount_id', 'product_id');
    }
}
