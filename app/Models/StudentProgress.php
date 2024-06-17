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

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lastAccessedContent()
    {
        return $this->belongsTo(CourseContent::class, 'last_accessed_content_id');
    }

    public function progressData()
    {
        return $this->hasMany(StudentProgressData::class);
    }
}
