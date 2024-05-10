<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProgressData extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function StudentProgressBelongs(): BelongsTo
    {
        return $this->belongsTo(StudentProgress::class);
    }

    public function CourseResource(): HasOne
    {
        return $this->hasOne(CourseContent::class);
    }
}
