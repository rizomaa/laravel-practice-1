<?php

use Illuminate\Http\Request;

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

Route::post('/token', 'Auth\LoginController@getToken');

//all route has api in the beginning of the path, for this example it will be /api/quesstions
Route::get('/questions', 'Api\QuestionsController@index');

Route::get('/questions/{slug}', 'Api\QuestionDetailsController');

//Protect our source with middleware
Route::middleware(['auth:api'])->group(function() {
    Route::apiResource('/questions', 'Api\QuestionsController')->except('index');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
