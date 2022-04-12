<?php

namespace App\Http\Controllers\Lecturer;

use App\Models\Form;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UtmleadAdministrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function list()
    {
        $lecturer = Auth::user();

        $courses = Course::where('lectureID', $lecturer->id)
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

    public function setForm(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'FormID' => 'integer|required|exists:App\Models\Form,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $course = Course::find($id);

        $course->setform($request->input('FormID'));

        return response()->json([
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
