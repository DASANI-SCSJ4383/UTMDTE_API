<?php

namespace App\Http\Controllers\UtmleadAdministrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UtmleadAdministrator;

class MainController extends Controller
{
    public function dashboard()
    {
        $users = UtmleadAdministrator::all();
        $success =  $users;

        return response()->json($success, 200);
    }
}
