<?php 

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function getAll()    
    {
        return Course::with('category')->get();
    }

    public function findByID($id)    
    {
        return Course::with('category')->findOrFail($id);
    }

    public function create(array $data)    
    {
        return Course::create($data);
    }

    public function update($id, array $data)    
    {
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course;
    }

    public function delete($id)    
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return $course;
    }
}