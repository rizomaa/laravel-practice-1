<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;



class VoteQuestionController extends Controller
{
    public function __contructor() {
        $this->middleware('auth');
    }
    
    public function __invoke(Question $question) {
        
        $vote = (int)request()->vote;
        
        //call Laravel auth helper
        $votesCount = auth()->user()->voteQuestion($question, $vote);
        
        if( request()->expectsJson()) {
            return response()->json([
                'message' => 'The vote count has been changed. Thanks for feedback.',
                'votesCount' => $votesCount
            ]);
        }

        return back();
    }
}
