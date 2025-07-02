<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    protected $guarded = [];
    
    // Define any relationships if needed
    // if you have a Department model and want to relate it:
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
