<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'id');
    }

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function advances(): HasMany
    {
        return $this->hasMany(AdvanceSalary::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }
}
