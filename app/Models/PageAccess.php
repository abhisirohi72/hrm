<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageAccess extends Model
{
    protected $table = 'page_accesses';

    protected $fillable = [
        'department_id',
        'page_name',
        'is_access',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
