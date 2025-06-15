<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Attendance extends Model
{
    protected $guarded=[];

    public function employees(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
