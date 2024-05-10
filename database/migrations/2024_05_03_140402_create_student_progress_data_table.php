<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_progress_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_progress_id')->constrained('student_progress')->cascadeOnDelete();
            $table->foreignId('content_id')->constrained('course_contents')->cascadeOnDelete();
            $table->text('completed_content');
            $table->timestamps();
        });

        Schema::table('student_progress_data', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_progress_data', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('student_progress_data');
    }
};
