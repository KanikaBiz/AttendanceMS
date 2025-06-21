<?php

namespace App\Models;

use App\Models\User;
use App\Models\ClassSchedule;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $fillable = [
        'class_schedule_id',
        'subject_code',
        'subject_name',
        'teacher_id',
        'day',
        'total_credit',
    ];

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function getSubjectNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function getDayAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
    public function getTotalCreditAttribute($value)
    {
        return (int) $value;
    }
    public function getClassScheduleIdAttribute($value)
    {
        return (int) $value;
    }
    public function getTeacherIdAttribute($value)
    {
        return (int) $value;
    }
    public function getIdAttribute($value)
    {
        return (int) $value;
    }
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
