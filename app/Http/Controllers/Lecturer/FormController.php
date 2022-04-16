<?php

namespace App\Http\Controllers\Lecturer;

use App\Models\Form;
use App\Traits\FormTrait;
use App\Traits\CourseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UtmleadAdministrator;

class FormController extends Controller
{
    use CourseTrait, FormTrait;

    public function list($courseID)
    {
        $course = $this->getCourse($courseID);

        if ($course->formid != null) {
            $currentForm = $this->getForm($course->formid);
            $currentFormId = $currentForm->id;
        } else {
            $currentFormId = -1;
        }

        $forms = Form::whereNot('id', $currentFormId)
            ->get()
            ->each(function ($form) {
                $UtmleadAdministratorName = UtmleadAdministrator::find($form->utmleadadministratorid)->user->name;
                $form->setAttribute('UtmleadAdministratorName', $UtmleadAdministratorName);
            });

        if ($currentFormId != -1) {
            $UtmleadAdministratorName = UtmleadAdministrator::find($currentForm->utmleadadministratorid)->user->name;
            $currentForm->setAttribute('UtmleadAdministratorName', $UtmleadAdministratorName);

            $course->setAttribute('form', $currentForm);
            unset($course->formid);

            $forms->prepend($currentForm);
        }

        return response()->json([
            'forms' => $forms,
            'course' => $course,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function view($id)
    {
        $form = $this->getForm($id);

        $UtmleadAdministratorName = UtmleadAdministrator::find($form->utmleadadministratorid)->user->name;
        $form->setAttribute('UtmleadAdministratorName', $UtmleadAdministratorName);

        $form->setAttribute('rubrics', $form->rubrics);

        return response()->json([
            'form' => $form,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
