<?php

namespace App\Models;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    protected $table = 'class_students';
    protected $fillable = ['class_id', 'student_id', 'status'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
