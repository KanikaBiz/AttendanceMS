<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'years';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function classes()
    {
        return $this->hasManyThrough(ClassModel::class, Semester::class);
    }
}
