<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Services\ClassesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateStudyPlanRequest;

class ClassesController extends Controller
{
    private $classService;

    public function __construct(ClassesService $classService)
    {
        $this->classService = $classService;
    }

    public function index(): JsonResponse
    {
        try {
            $classes = $this->classService->getAllClasses();
            return response()->json($classes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Classes $class): JsonResponse
    {
        try {
            $classData = $this->classService->getClassDetails($class);
            return response()->json($classData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreClassesRequest $request): JsonResponse
    {
        try {
            $class = $this->classService->createClass($request->validated());
            return response()->json($class);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getStudyPlan(Classes $class): JsonResponse
    {
        try {
            $studyPlan = $this->classService->getStudyPlan($class);
            return response()->json($studyPlan);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateStudyPlan(UpdateStudyPlanRequest $request, Classes $class): JsonResponse
    {
        try {
            $updatedClass = $this->classService->updateStudyPlan($class, $request->validated()['lectures']);
            return response()->json($updatedClass);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update(StoreClassesRequest $request, Classes $class): JsonResponse
    {
        try {
            $updatedClass = $this->classService->updateClass($class, $request->validated());
            return response()->json($updatedClass);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Classes $class): JsonResponse
    {
        try {
            $this->classService->deleteClass($class);
            return response()->json(['message' => 'Deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
