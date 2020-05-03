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

//Route::post('/token', 'Auth\LoginController@getToken'); - it is not needed yet
Route::post('/login', 'Api\Auth\LoginController@store');
Route::delete('/logout', 'Api\Auth\LoginController@destroy')->middleware('auth:api');
Route::post('/register', 'Api\Auth\RegisterController');

//all route has api in the beginning of the path, for this example it will be /api/quesstions
Route::get('/questions', 'Api\QuestionsController@index');
Route::get('/questions/{question}/answers', 'Api\AnswersController@index');
    
//Route::get('/questions/{question}-{slug}', 'Api\QuestionDetailsController');
Route::get('/questions/{question}', 'Api\QuestionDetailsController@');
Route::get('/question/{slug}', 'Api\QuestionDetailsController');


//Protect our source with group middleware
Route::middleware(['auth:api'])->group(function() {
    Route::apiResource('/questions', 'Api\QuestionsController')->except('index');
    Route::apiResource('/questions.answers', 'Api\AnswersController')->except('index');
    
    //we do not need to specify the method 
    Route::post('/questions/{question}/vote', 'VoteQuestionController');
    Route::post('/answers/{answer}/vote', 'VoteAnswerController');
    
    Route::post('/answers/{answer}/accept', 'AcceptAnswerController');
    Route::post('/questions/{question}/favorites', 'FavoritesController@store');
    Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy');
    Route::get('/myposts', 'Api\MyPostsController');    
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
