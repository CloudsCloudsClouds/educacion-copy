<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseContent extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Assessments(): BelongsToMany
    {
        return $this->belongsToMany(Assessment::class);
    }

    public function StudentProgressess(): BelongsToMany
    {
        return $this->belongsToMany(StudentProgress::class);
    }

    public function StudenProgressessData(): BelongsToMany
    {
        return $this->belongsToMany(StudentProgressData::class);
    }

    public function Course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function CourseReferences(): HasMany
    {
        return $this->hasMany(CourseReference::class);
    }
}
