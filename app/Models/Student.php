<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function StudentProgresses(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }

    public function CourseComments(): HasMany
    {
        return $this->hasMany(CourseComment::class);
    }

    public function Assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }
}
