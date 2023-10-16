<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, 'class_lecture', 'class_id', 'lecture_id')->withPivot('order')->orderBy('order');
    }
}
