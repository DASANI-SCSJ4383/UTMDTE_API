<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenication(Request $request)
    {
        $loginData = $request->all();

        $validator = Validator::make($loginData, [
            'UTMID' => 'required',
            'Password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $loginData = [
            'utmID' => $request->UTMID,
            'password' => $request->Password
        ];

        if (auth()->attempt($loginData)) {
            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            $user = array_merge(auth()->user()->toArray(), auth()->user()->userable->toArray());
            $userType = explode("\\", auth()->user()->userable_type)[2];

            return response()->json(['user' => $user, 'userType' => $userType, 'access_token' => $accessToken], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function profile()
    {
        $user = array_merge(auth()->user()->toArray(), auth()->user()->userable->toArray());
        $userType = explode("\\", auth()->user()->userable_type)[2];

        return response()->json(['user' => $user, 'userType' => $userType,], 201);
    }

    public function fail()
    {
        return response()->json([
            "message" => 'Access Denied',
        ], 403);
    }
}
