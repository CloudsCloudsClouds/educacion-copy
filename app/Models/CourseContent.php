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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function references()
    {
        return $this->hasMany(CourseReference::class);
    }

    public function studentProgressData()
    {
        return $this->hasMany(StudentProgressData::class, 'content_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'content_id');
    }
}
