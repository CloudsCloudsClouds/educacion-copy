<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseReference extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function courseContent()
    {
        return $this->belongsTo(CourseContent::class);
    }
}
