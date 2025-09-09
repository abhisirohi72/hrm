<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Department;

class Branch extends Model
{
    protected $guarded=[];

    public function departments(){
        return $this->belongsTo(Department::class,"dept_id", "id");
    }

    public function employees() : HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
