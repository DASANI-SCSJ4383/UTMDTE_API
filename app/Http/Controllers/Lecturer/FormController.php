<?php

namespace App\Http\Controllers\Lecturer;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UtmleadAdministrator;

class FormController extends Controller
{
    public function list()
    {
        $forms = Form::with('rubrics')
            ->get()
            ->each(function ($form) {
                $utmleadAdminName = UtmleadAdministrator::find($form->utmleadAdministratorID)->user()->name;
                $form->setAttribute('utmleadAdminName', $utmleadAdminName);
            });

        return response()->json([
            'forms' => $forms,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function view($id)
    {
        $form = Form::with('rubrics')
            ->find($id);

        $utmleadAdminName = UtmleadAdministrator::find($form->utmleadAdministratorID)->user()->name;
        $form->setAttribute('utmleadAdminName', $utmleadAdminName);

        return response()->json([
            'form' => $form,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
