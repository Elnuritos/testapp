<?php

namespace App\Services;

use App\Models\Classes;

class ClassesService
{
    public function getAllClasses()
    {
        return Classes::all();
    }

    public function getClassDetails(Classes $class)
    {
        return $class->load('students');
    }

    public function getStudyPlan(Classes $class)
    {
        return $class->load('lectures');
    }

    public function updateStudyPlan(Classes $class, array $lecturesData)
    {
        $syncData = [];
        foreach ($lecturesData as $lectureData) {
            $syncData[$lectureData['lecture_id']] = ['order' => $lectureData['order']];
        }

        $class->lectures()->sync($syncData);
        return $class->load(['lectures' => function ($query) {
            $query->orderBy('class_lecture.order', 'asc');
        }]);
    }

    public function createClass(array $data)
    {
        return Classes::create($data);
    }

    public function updateClass(Classes $class, array $data)
    {
        $class->update($data);
        return $class;
    }

    public function deleteClass(Classes $class)
    {
        $class->students()->detach();
        $class->delete();
    }


}
