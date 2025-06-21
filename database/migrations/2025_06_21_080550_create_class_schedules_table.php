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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('class_code')->unique();
            $table->string('semester');
            $table->text('class_description')->nullable();
            $table->timestamps();
        });

        Schema::create('class_subjects', function (Blueprint $table) {
          $table->id();
          $table->foreignId('class_schedule_id')->constrained()->onDelete('cascade');
          $table->string('subject_code');
          $table->string('subject_name');
          $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
          $table->enum('day', ['Monday', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']);
          $table->integer('total_credit');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
        Schema::dropIfExists('class_subjects');

    }
};
