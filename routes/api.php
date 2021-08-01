<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (Request $request) {

    $showCategory = new \App\Services\ShowCategory();

    $results = $showCategory->getTree($showCategory->testData, 0, 0);

    return ['data' => $results];
});


Route::get('/test4', function (Request $request) {


    $testData = [

        [
            'id' => 1,
            'parent_id' => 0,
            'name' => 'a',
        ],
        [
            'id' => 2,
            'parent_id' => 1,
            'name' => 'b',

        ],[
            'id' => 3,
            'parent_id' => 2,
            'name' => 'c',
        ],[
            'id' => 4,
            'parent_id' => 2,
            'name' => 'd',
        ]
    ];

    $category = new \App\Services\Category();

    return $category->getTree($testData);
});

