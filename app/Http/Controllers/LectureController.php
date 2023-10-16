<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLectureRequest;
use App\Models\Lecture;
use App\Services\LectureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LectureController extends Controller
{
    private $lectureService;

    public function __construct(LectureService $lectureService)
    {
        $this->lectureService = $lectureService;
    }

    public function index(): JsonResponse
    {
        try {
            $lectures = $this->lectureService->getAllLectures();
            return response()->json($lectures);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Lecture $lecture): JsonResponse
    {
        try {
            $lectureData = $this->lectureService->getLectureDetails($lecture);
            return response()->json($lectureData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreLectureRequest $request): JsonResponse
    {
        try {
            $lecture = $this->lectureService->createLecture($request->validated());
            return response()->json($lecture);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(StoreLectureRequest $request, Lecture $lecture): JsonResponse
    {
        try {
            $updatedLecture = $this->lectureService->updateLecture($lecture, $request->validated());
            return response()->json($updatedLecture);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Lecture $lecture): JsonResponse
    {
        try {
            $this->lectureService->deleteLecture($lecture);
            return response()->json(['message' => 'Deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
