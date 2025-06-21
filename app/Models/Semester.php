<?php

namespace App\Models;

use App\Models\Year;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';

    protected $fillable = [
        'name',
        'year_id',
        'status',
    ];

public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'semester_id');
    }
}
