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
        Schema::create('course_references', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->binary('text')->nullable();
            $table->foreignId('course_content_id')->constrained('course_contents')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::table('course_references', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_references');
        Schema::table('course_references', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
