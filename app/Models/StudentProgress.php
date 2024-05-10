<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProgress extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Students(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function LastCourseReference(): HasOne
    {
        return $this->hasOne(CourseContent::class);
    }

    public function StudentProgressData(): HasMany
    {
        return $this->hasMany(StudentProgressData::class);
    }
}
