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
        Schema::create('routine_details', function (Blueprint $table) {
            $table->id();      
            $table->foreign('routine_id')->references('id')->on('routines')->onDelete('cascade');
            $table->foreignId('course_id')->nullable();
            $table->foreignId('teacher_id')->nullable();
            $table->string('day_one')->nullable();
            $table->string('day_two')->nullable();
            $table->string('time')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routine_details');
    }
};
