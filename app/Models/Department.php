<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $guarded=[];

    public function branches() : HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function employees() : HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function sops() : HasMany
    {
        return $this->hasMany(Sop::class);
    }
}
