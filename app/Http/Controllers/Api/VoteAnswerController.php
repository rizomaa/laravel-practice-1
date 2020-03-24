<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoteAnswerController extends Controller
{
    public function __invoke(Answer $answer) {
        
        $vote = (int) request()->vote;        
        $votesCount = auth()->user()->voteAnswer($answer, $vote);
           
        return response()->json([
            'message' => 'The vote count has been changed. Thanks for feedback.',
            'votesCount' => $votesCount
        ]);
    }
}
