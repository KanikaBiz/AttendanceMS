<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\SubjectTeacher;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTeacher extends Model
{
    protected $table = 'class_subject_teachers';
    protected $fillable = ['class_id', 'subject_teacher_id', 'status'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjectTeacher()
    {
        return $this->belongsTo(SubjectTeacher::class, 'subject_teacher_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'subject_teacher_id');
    }
}
