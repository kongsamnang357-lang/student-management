<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_name', 'email', 'gender', 'dob',
        'enrollment_date', 'description', 'dept_id',
    ];

    protected $casts = [
        'dob' => 'date',
        'enrollment_date' => 'date',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
    }

    // Years since the enrollment date (shown as "Years Enrolled")
    public function getYearsEnrolledAttribute(): float
    {
        return round(abs($this->enrollment_date->diffInDays(now())) / 365.25, 2);
    }
}
