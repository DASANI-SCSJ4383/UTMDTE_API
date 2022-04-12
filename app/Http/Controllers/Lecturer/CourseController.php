<?php

namespace App\Http\Controllers\Lecturer;

use App\Models\Form;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UtmleadAdministrator;

class CourseController extends Controller
{
    public function list($lecturerID)
    {
        $courses = Course::where('lectureID', $lecturerID)
            ->get()
            ->each(function ($course) {
                if (isset($course->formID)) {
                    $form = Form::find($course->formID);
                    $utmleadAdmin = UtmleadAdministrator::find($form->utmleadAdministratorID);
                    $utmleadAdminName = $utmleadAdmin->user()->name;

                    $course->setAttribute('utmleadAdminName', $utmleadAdminName);
                }
            });

        return response()->json([
            'courses' => $courses,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function view($id)
    {
        $course = Course::find($id);

        return response()->json([
            'course' => $course,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function set($id, $formID)
    {
        $course = Course::find($id);

        $course->setform($formID);

        return response()->json([
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
