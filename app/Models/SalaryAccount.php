<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryAccount extends Model
{
    protected $fillable = [
        'account_holder_name',
        'bank_name',
        'account_number',
        'account_type',
        'ifsc_code',
        'branch_name',
        'branch_address'
    ];

    protected $casts = [
        'account_type' => 'string',
    ];
}
