<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(): JsonResponse
    {
        try {
            $students = $this->studentService->getAllStudents();
            return response()->json($students);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Student $student): JsonResponse
    {
        try {
            $studentData = $this->studentService->getStudentDetails($student);
            return response()->json($studentData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        try {
            $student = $this->studentService->createStudent($request->validated());
            return response()->json($student);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(StoreStudentRequest $request, Student $student): JsonResponse
    {
        try {
            $updatedStudent = $this->studentService->updateStudent($student, $request->validated());
            return response()->json($updatedStudent);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Student $student): JsonResponse
    {
        try {
            $this->studentService->deleteStudent($student);
            return response()->json(['message' => 'Deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
