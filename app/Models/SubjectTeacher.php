<?php

namespace App\Models;

use App\Models\User;
use App\Models\Subject;
use App\Models\ClassSubjectTeacher;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $table = 'subject_teachers';
    protected $fillable = ['subject_id', 'teacher_id', 'status'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function classSubjectTeachers()
    {
        return $this->hasMany(ClassSubjectTeacher::class, 'subject_teacher_id');
    }
}
