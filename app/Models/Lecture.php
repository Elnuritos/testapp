<?php

namespace App\Models;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = ['topic', 'description'];

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_lecture', 'lecture_id', 'class_id')->withPivot('order');
    }
}
