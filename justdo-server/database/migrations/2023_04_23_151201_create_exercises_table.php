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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id('exercise_id');
            $table->integer('difficulty'); // 1-5
        });

        Schema::create('exercises_language', function (Blueprint $table) {
            $table->id('exercise_language_id');
            $table->unsignedBigInteger('exercise_id');
            $table->string('language_code', 2);

            $table->string('exercise');
            $table->string('description');

            $table->foreign('exercise_id')->references('exercise_id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises_language');
        Schema::dropIfExists('exercises');
    }
};
