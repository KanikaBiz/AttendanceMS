<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\ClassSubject;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    // protected $fillable = ['class_name', 'class_code', 'semester', 'class_description'];
    protected $guarded = [];
    protected $table = 'class_schedules';

    public function subjects()
    {
        return $this->hasMany(ClassSubject::class);
    }
    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, ClassSubject::class);
    }

    public function getClassNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
    public function getClassCodeAttribute($value)
    {
        return strtoupper($value);
    }
    public function getSemesterAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
}
