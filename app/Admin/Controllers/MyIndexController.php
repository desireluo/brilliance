<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyIndexController extends Controller
{

    public function index(Request $request)
    {

        return view('myIndex.index');
    }

}
