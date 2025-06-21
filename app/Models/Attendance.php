<?php

namespace App\Models;

use App\Models\User;
use App\Models\ClassModel;
use App\Models\ClassSubjectTeacher;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    // protected $fillable = ['class_id', 'subject_teacher_id', 'student_id', 'attendance_date', 'status'];
    protected $guarded = [];
    protected $casts = [
        'attendance_date' => 'date',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjectTeacher()
    {
        return $this->belongsTo(ClassSubjectTeacher::class, 'subject_teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class, 'class_subject_id');
    }


}
