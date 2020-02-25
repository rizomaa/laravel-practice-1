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
        auth()->user()->voteQuestion($question, $vote);

        return back();
    }
}
