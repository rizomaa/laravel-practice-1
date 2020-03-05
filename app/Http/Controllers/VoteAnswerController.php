<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;


class VoteAnswerController extends Controller
{
    public function __constructor() {
        $this->middleware('auth');
    }
    
    public function __invoke(Answer $answer) {
        $vote = (int) request()->vote;
        
        $votesCount = auth()->user()->voteAnswer($answer, $vote);
        
        if( request()->expectsJson()) {
            return response()->json([
                'message' => 'The vote count has been changed. Thanks for feedback.',
                'votesCount' => $votesCount
            ]);
        }

        return back();
    }
    
}
