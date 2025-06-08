<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'code',
        'description',
        'semester_id',
        'status',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
