<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequireJsController extends Controller
{

    public function index(Request $request)
    {
        return view('require-js.index');
    }

}
