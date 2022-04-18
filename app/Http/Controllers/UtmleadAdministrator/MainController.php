<?php

namespace App\Http\Controllers\UtmleadAdministrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UtmleadAdministrator;

class MainController extends Controller
{
    public function dashboard()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
