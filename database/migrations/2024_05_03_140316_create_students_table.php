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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('second_name');
            $table->string('middle_name')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('rude');
            $table->string('ci');
            $table->string('direction');
            $table->string('course');
            $table->integer('age');
            $table->date('birth_date');
            $table->integer('institution_code');
            $table->timestamps();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::table('students', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
