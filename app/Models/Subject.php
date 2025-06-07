<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'code',
        'description',
        'class_id',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'subject_permissions');
    }
}
