<?php

namespace App\Http\Controllers\Lecturer;

use App\Models\Form;
use App\Models\Course;
use App\Traits\CourseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use CourseTrait;

    public function list()
    {
        $lecturer = Auth::user();

        $courses = $this->getCoursesByLecturer($lecturer->userable_id);

        return response()->json([
            'courses' => $courses,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function view($id)
    {
        $course = $this->getCourse($id);

        return response()->json([
            'course' => $course,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function setForm(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'FormID' => 'integer|required|exists:App\Models\Form,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $course = $this->getCourse($id);

        $course->setform($request->input('FormID'));

        $course->save();

        return response()->json([
            'message' => 'success'
        ], 201, [], JSON_NUMERIC_CHECK);
    }

    public function unsetForm($id)
    {
        $course = $this->getCourse($id);

        $course->formid = null;

        $course->save();

        return response()->json([
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
