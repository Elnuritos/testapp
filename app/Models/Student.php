<?php

namespace App\Models;

use App\Models\Classes;
use App\Models\Lecture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'class_id'];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, 'class_lecture', 'class_id', 'lecture_id');
    }
}
