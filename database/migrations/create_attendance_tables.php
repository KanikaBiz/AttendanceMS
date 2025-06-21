<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       // Year table
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "2023-2024"
            $table->string('description')->nullable(); // Optional description
            //status
            $table->enum('status', [1, 0])->default(1); // Status of the year
            $table->timestamps();
        });
        // Table Semesters
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Fall 2023", "Spring 2024"
            $table->foreignId('year_id')->constrained('years')->onDelete('cascade'); // Foreign key to years table
            $table->enum('status', [1, 0])->default(1); // Status of the semester
            $table->timestamps();
        });
      // Classes with Semesters table
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Math 101", "Web Security"
            $table->string('code')->unique(); // e.g. "MATH101", "WEBSEC"
            $table->string('description')->nullable(); // Optional description
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade'); // Foreign key to semesters table
            $table->enum('status', [1, 0])->default(1); // Status of the class
            $table->timestamps();
        });

      // Table Subjects
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Mathematics", "Web Security"
            $table->string('code')->unique(); // e.g. "MATH", "WEBSEC"
            $table->string('description')->nullable(); // Optional description
             $table->enum('status', [1, 0])->default(1); // Status of the year
            $table->timestamps();
        });

        // Table subject teachers
        Schema::create('subject_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); // Assuming users table has teacher records
            $table->enum('status', [1, 0])->default(1); // Status of the subject teacher
            $table->timestamps();
        });

        //create table class subject teachers
        Schema::create('class_subject_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('subject_teacher_id')->constrained('subject_teachers')->onDelete('cascade');
            $table->enum('status', [1, 0])->default(1); // Status of the class subject teacher
            $table->timestamps();
        });

      // Students register in class
        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // Assuming users table has student records
            $table->enum('status', [1, 0])->default(1); // Status of the year
            $table->timestamps();
        });



        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_subject_id')->constrained('class_subjects')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->date('attendance_date');
            $table->string('status')->default('absent');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
      // Drop the tables in reverse order of creation to avoid foreign key constraints
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('class_students');
        Schema::dropIfExists('class_subject_teachers');
        Schema::dropIfExists('subject_teachers');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('years');

    }
};
