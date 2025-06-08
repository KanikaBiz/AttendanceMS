<?php

namespace App\Models;

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
}
