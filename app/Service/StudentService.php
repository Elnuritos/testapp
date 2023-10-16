<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    public function getAllStudents()
    {
        return Student::with('class', 'lectures')->get();
    }

    public function getStudentDetails(Student $student)
    {
        return $student->load('class', 'lectures');
    }

    public function createStudent(array $data)
    {
        return Student::create($data);
    }

    public function updateStudent(Student $student, array $data)
    {
        $student->update($data);
        return $student->load('class', 'lectures');
    }

    public function deleteStudent(Student $student)
    {
        $student->delete();
    }
}
