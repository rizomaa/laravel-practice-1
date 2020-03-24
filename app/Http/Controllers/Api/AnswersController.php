<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Answer;
use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AnswerResource;

class AnswersController extends Controller
{  
    public function index(Question $question) {
        $answers = $question->answers()->with('user')->simplePaginate(3);
        
        return AnswerResource::collection($answers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
                
        $answer = $question->answers()->create($request->validate([
            'body' => 'required'
        ]) + ['user_id' => Auth::id()]); //Merge with plus operator...
        
       
        return response()->json([
            'message' => 'The answer has been added.',
            'answer' => new AnswerResource($answer->load('user'))
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        
        $answer->update($request->validate([
            'body' => 'required',
        ]));        
       
        return response()->json([
            'message' => 'Your answer has been saved.',
            'body_html' => $answer->body_html
        ]);
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        
        $answer->delete();
        
        return response()->json([
            'message' => 'Your answer has been removed.'
        ]);
        
    }   
}

