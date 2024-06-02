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
        Schema::create('fituser_exercise', function (Blueprint $table)
        {
            $table->unsignedBigInteger('fituser_id');
            $table->unsignedBigInteger('exercise_id');
            $table->integer('reps');

            $table->foreign('fituser_id')->references('fituser_id')->on('fitusers')->onDelete('cascade');
            $table->foreign('exercise_id')->references('exercise_id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fituser_exercise');
    }
};
