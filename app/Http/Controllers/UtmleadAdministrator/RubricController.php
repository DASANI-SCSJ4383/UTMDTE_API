<?php

namespace App\Http\Controllers\UtmleadAdministrator;

use App\Models\Form;
use App\Models\Rubric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RubricController extends Controller
{
    public function list($formID)
    {
        $form = Form::find($formID);
        $rubrics = $form->rubrics;

        return response()->json([
            'rubrics' => $rubrics,
            'form' => $form,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function view($id)
    {
        $rubric = Rubric::find($id);

        return response()->json([
            'rubric' => $rubric,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function create(Request $request, $formID)
    {
        $validator = Validator::make($request->all(), [
            'RubricType' => 'required|string',
            'Description' => 'required|string',
            'Answers' => 'array|required_unless:RubricType,Textbox|nullable',
            'Answers.*' => 'distinct',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'error'
            ], 404);
        }

        $rubric = new Rubric;

        $rubric->rubricType = $request->RubricType;
        $rubric->description = $request->Description;
        $rubric->answers = $request->Answers;

        $form = Form::find($formID);
        $form->rubrics()->save($rubric);

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'RubricType' => 'required|string',
            'Description' => 'required|string',
            'Answers' => 'array|required_unless:RubricType,Textbox|nullable',
            'Answers.*' => 'distinct',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'error'
            ], 404);
        }

        $rubric = Rubric::find($id);

        $rubric->rubricType = $request->RubricType;
        $rubric->description = $request->Description;
        $rubric->answers = $request->Answers;

        $rubric->save();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function delete($id)
    {
        Rubric::find($id)->delete();

        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
