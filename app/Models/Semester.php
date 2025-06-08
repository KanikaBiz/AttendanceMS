<?php

namespace App\Models;

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
        return $this->belongsTo(Year::class);
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
}
