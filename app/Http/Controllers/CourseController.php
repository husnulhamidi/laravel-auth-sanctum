<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }   

    public function index(){
        $data = $this->courseService->getAllCourses();
        return response()->json($data);
    }

    public function store(Request $request){
        $data = $request->validate([
            "title" => "required|string|max:191",
            "description" => "required|string",
            "category_id" => "required|integer",
        ]);

        return response()->json($this->courseService->createCourse($data));
    }

    public function show($id){
        return response()->json($this->courseService->getCourseByID($id));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            "title" => "required|string|max:191",
            "description" => "required|string",
            "category_id" => "required|integer",
        ]);

        return response()->json($this->courseService->updateCourse($id, $data));
    }

    public function destroy($id){
        return response()->json(['deleted' => $this->courseService->deleteCourse($id)]);
    }
}
