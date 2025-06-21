<?php

namespace App\Models;

use App\Models\ClassModel;
use App\Models\SubjectTeacher;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // protected $table = 'subjects';

    // protected $fillable = [
    //     'name',
    //     'code',
    //     'description',
    //     'status',
    // ];
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class, 'subject_id');
    }
}
