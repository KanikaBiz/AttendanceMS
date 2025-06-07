<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Year;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\ClassModel;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
    $this->call([
      RoleTableSeeder::class,
      PermissionRoleTableSeeder::class,
      UserTableSeeder::class,
      RoleUserTableSeeder::class,
    ]);

    // Seed Years
        $years = [
            ['name' => '2023-2024'],
            ['name' => '2024-2025'],
        ];

        foreach ($years as $year) {
            Year::create($year);
        }

        // Seed Semesters
        $semesters = [
            ['name' => 'Fall 2023', 'year_id' => 1],
            ['name' => 'Spring 2024', 'year_id' => 1],
            ['name' => 'Fall 2024', 'year_id' => 2],
            ['name' => 'Spring 2025', 'year_id' => 2],
        ];

        foreach ($semesters as $semester) {
            Semester::create($semester);
        }

        // Seed Classes
        $classes = [
            ['name' => 'Mathematics 101', 'code' => 'MATH101', 'description' => 'Introduction to Algebra', 'semester_id' => 1],
            ['name' => 'Web Security', 'code' => 'WEBSEC101', 'description' => 'Basics of Cybersecurity', 'semester_id' => 1],
            ['name' => 'Physics 101', 'code' => 'PHYS101', 'description' => 'Mechanics and Thermodynamics', 'semester_id' => 2],
        ];

        foreach ($classes as $class) {
            ClassModel::create($class);
        }

        // Seed Subjects
        $subjects = [
            ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Algebra and Calculus'],
            ['name' => 'Web Security', 'code' => 'WEBSEC', 'description' => 'Cybersecurity Fundamentals'],
            ['name' => 'Physics', 'code' => 'PHYS', 'description' => 'Physical Sciences'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }



  }
}
