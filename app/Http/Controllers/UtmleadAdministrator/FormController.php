<?php

namespace App\Http\Controllers\UtmleadAdministrator;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function list()
    {
        $utmleadAdmin = Auth::user();

        $forms = Form::with('rubrics')
            ->where("utmleadAdministratorID", $utmleadAdmin->id)
            ->get();

        return response()->json([
            'forms' => $forms,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function view($id)
    {
        $form = Form::with('rubrics')
            ->find($id);

        return response()->json([
            'form' => $form,
            'message' => 'success'
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Title' => 'required|string',
            'Description' => 'required|string',
        ]);

        $utmleadAdmin = auth::user();

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'error'
            ], 404);
        }

        $form = new Form;

        $form->title = $request->Title;
        $form->description = $request->Description;
        $form->utmleadAdministratorID = $utmleadAdmin->id;

        $form->save();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Title' => 'required|string',
            'Description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'error'
            ], 404);
        }

        $form = Form::find($id);

        $form->title = $request->Title;
        $form->description = $request->Description;

        $form->save();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function delete($id)
    {
        Form::find($id)->delete();

        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
