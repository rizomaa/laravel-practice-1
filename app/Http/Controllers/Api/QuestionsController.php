<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           //\DB::enableQueryLog();
        $questions = Question::with('user')->latest()->paginate(10);
        
        
        return QuestionResource::collection($questions);
        //return view('questions.index', compact('questions'));
        //view('questions.index', compact('questions'))->render();
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
       //dd('store!!!');
        $question = $request->user()->questions()->create($request->only('title', 'body'));
        
        //return redirect('/questions');
        //return redirect()->route('questions.index')->with('success', 'Your question has been submitted');
        
        return response()->json([
            'message' => 'Your question has been submitted',
            'question' => new QuestionResource($question)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return response()->json([
            'title' => $question->title,
            'body' =>$question->body,
            'body_html' => $question->body_html
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);
        
        $question->update($request->only('title', 'body'));
        
        return response()->json([
            'message' => 'The question has been updated',
            'body_html' => $question->body_html
                ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {   
        $this->authorize('delete', $question);
        
        $question->delete();
        
        return response()->json([
              'message'  => 'Your question has been deleted'
            ]);
    }
}