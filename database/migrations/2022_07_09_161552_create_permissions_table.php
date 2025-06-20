<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->string('group')->nullable();
        $table->string('title')->nullable();
        $table->boolean('status')->default(true);
        $table->timestamps();
        $table->softDeletes();
      });

      $permissions = [
        [
          'id'    => 1,
          'title' => 'dashboard_access',
          'group' => 'Dashboard'
        ],
        [
          'id'    => 2,
          'title' => 'user_management_access',
          'group' => 'User Management'
        ],
        [
          'id'    => 3,
          'title' => 'permission_create',
          'group' => 'Permission'
        ],
        [
          'id'    => 4,
          'title' => 'permission_edit',
          'group' => 'Permission'
        ],
        [
          'id'    => 5,
          'title' => 'permission_show',
          'group' => 'Permission'
        ],
        [
          'id'    => 6,
          'title' => 'permission_delete',
          'group' => 'Permission'
        ],
        [
          'id'    => 7,
          'title' => 'permission_access',
          'group' => 'Permission'
        ],
        [
          'id'    => 8,
          'title' => 'role_create',
          'group' => 'Role'
        ],
        [
          'id'    => 9,
          'title' => 'role_edit',
          'group' => 'Role'
        ],
        [
          'id'    => 10,
          'title' => 'role_show',
          'group' => 'Role'
        ],
        [
          'id'    => 11,
          'title' => 'role_delete',
          'group' => 'Role'
        ],
        [
          'id'    => 12,
          'title' => 'role_access',
          'group' => 'Role'
        ],
        [
          'id'    => 13,
          'title' => 'user_create',
          'group' => 'User'
        ],
        [
          'id'    => 14,
          'title' => 'user_edit',
          'group' => 'User'
        ],
        [
          'id'    => 15,
          'title' => 'user_show',
          'group' => 'User'
        ],
        [
          'id'    => 16,
          'title' => 'user_delete',
          'group' => 'User'
        ],
        [
          'id'    => 17,
          'title' => 'user_access',
          'group' => 'User'
        ],
        [
          'id'    => 18,
          'title' => 'user_profile_password_edit',
          'group' => 'User'
        ],
        [
          'id'    => 19,
          'title' => 'user_profile_password_show',
          'group' => 'User'
        ],
        [
          'id'    => 20,
          'title' => 'user_profile_password_delete',
          'group' => 'User'
        ],
        [
          'id'    => 21,
          'title' => 'user_profile_password_access',
          'group' => 'User'
        ],
        // Teacher
        [
          'id'    => 22,
          'title' => 'teacher_create',
          'group' => 'Teacher'
        ],
        [
          'id'    => 23,
          'title' => 'teacher_edit',
          'group' => 'Teacher'
        ],
        [
          'id'    => 24,
          'title' => 'teacher_show',
          'group' => 'Teacher'
        ],
        [
          'id'    => 25,
          'title' => 'teacher_delete',
          'group' => 'Teacher'
        ],
        [
          'id'    => 26,
          'title' => 'teacher_access',
          'group' => 'Teacher'
        ],
        // Student
        [
          'id'    => 27,
          'title' => 'student_create',
          'group' => 'Student'
        ],
        [
          'id'    => 28,
          'title' => 'student_edit',
          'group' => 'Student'
        ],
        [
          'id'    => 29,
          'title' => 'student_show',
          'group' => 'Student'
        ],
        [
          'id'    => 30,
          'title' => 'student_delete',
          'group' => 'Student'
        ],
        [
          'id'    => 31,
          'title' => 'student_access',
          'group' => 'Student'
        ],
        // Subject
        [          'id'    => 32,
          'title' => 'subject_create',
          'group' => 'Subject'
        ],
        [          'id'    => 33,
          'title' => 'subject_edit',
          'group' => 'Subject'
        ],
        [          'id'    => 34,
          'title' => 'subject_show',
          'group' => 'Subject'
        ],
        [          'id'    => 35,
          'title' => 'subject_delete',
          'group' => 'Subject'
        ],
        [          'id'    => 36,
          'title' => 'subject_access',
          'group' => 'Subject'
        ],


      ];
      // Permission::insert($permissions);
      DB::table('permissions')->insert($permissions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
