<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'code', 'description', 'semester_id', 'status'];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function students()
    {
        return $this->hasMany(ClassStudent::class, 'class_id');
    }

    public function subjectTeachers()
    {
        return $this->hasMany(ClassSubjectTeacher::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'class_id');
    }
}
