<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class FavoritesController extends Controller
{
    public function __constructor() {
        $this->middleware('auth');//, ['include' => ['store', 'destroy'] ]);
    }
    
    public function store(Question $question) {
        
        $question->favorites()->attach(auth()->id());
        
        if( request()->expectsJson() ) {
            return response()->json([
               'message' => 'Favorited!'
            ]);
        }
       return back();
        
    }
    
    public function destroy(Question $question) {
        
        $question->favorites()->detach(auth()->id());
        
        if(request()->expectsJson()) {
            return response()->json([
               'message' => 'Unfovarited'
            ]);
        }
        return back();
    }
    
}
