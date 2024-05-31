<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseComment extends Model
{
    use HasFactory;

    public function StudentComments(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function CourseComment(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
