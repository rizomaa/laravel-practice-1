<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
        public function __invoke(Answer $answer) {
            
            $this->authorize('accept', $answer);
            
            $answer->question->acceptBestAnswer($answer);
            
            
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Your answer has been cosen as the best.'
                ]);
            }
            
            return back();
            //dd('accept the answer');
        }
}
