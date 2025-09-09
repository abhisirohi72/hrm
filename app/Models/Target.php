<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Target extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    // public function getTargetTypeAttribute($value)
    // {
    //     return $value == '0' ? 'No. Of Leads' : 'Total Collections';
    // }
}
