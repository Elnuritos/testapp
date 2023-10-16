<?php

namespace App\Services;

use App\Models\Lecture;

class LectureService
{
    public function getAllLectures()
    {
        return Lecture::all();
    }

    public function getLectureDetails(Lecture $lecture)
    {
        return $lecture->load('classes', 'classes.students');
    }

    public function createLecture(array $data)
    {
        return Lecture::create($data);
    }

    public function updateLecture(Lecture $lecture, array $data)
    {
        $lecture->update($data);
        return $lecture;
    }

    public function deleteLecture(Lecture $lecture)
    {
        $lecture->delete();
    }
}
