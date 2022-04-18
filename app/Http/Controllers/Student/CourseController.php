<?php

namespace App\Http\Controllers\Student;

use App\Traits\CourseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    use CourseTrait;

    public function list()
    {
        $student = Auth::user();

        $courses = $this->getCoursesByStudent($student->userable_id);

        return response()->json([
            'courses' => $courses,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
