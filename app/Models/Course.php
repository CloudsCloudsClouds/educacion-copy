<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function CourseContents(): HasMany
    {
        return $this->hasMany(CourseContent::class);
    }

    public function CourseComments(): HasMany
    {
        return $this->hasMany(CourseComment::class);
    }

    public function StudentProgress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }
}
