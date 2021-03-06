<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Answer extends Model
{
    
    use VotableTrait;
    
    protected $fillable = ['body', 'user_id'];
    
    protected $appends = ['created_date', 'body_html', 'is_best'];
    
    public function question() {
        return $this->belongsTo(Question::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    //such a function called as accessor
    public function getBodyHtmlAttribute() {
        
        //clean can bee added here
        return \Parsedown::instance()->text($this->body);
    }
    
    public static function boot() {
        parent::boot();
        
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
        });
        
        static::deleted(function($answer) {
                        
            $answer->question->decrement('answers_count');
            
            //relevant for lesson19a 
            //$question = $answer->question;
           // $question->decrement('answers_count');
          /*  if ($question->best_answer_id === $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }*/
        });
    }
    
    public function getCreatedDateAttribute() {
        return Carbon::parse($this->created_at)->diffForHumans();       
    }
    
    public function getStatusAttribute() {
        return $this->isBest() ? 'vote-accepted' : '';
    }
    
    public function getIsBestAttribute() {
        return $this->isBest();
    }
    
    public function isBest() {
        return $this->id === $this->question->best_answer_id;
    }   
     
}
