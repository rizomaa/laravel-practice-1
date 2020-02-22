<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Answer extends Model
{
    
    protected $fillable = ['body', 'user_id'];
    
    public function question() {
        return $this->belongsTo(Question::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    //such a function called as accessor
    public function getBodyHtmlAttribute() {
        return \Parsedown::instance()->text($thgit statusis->body);
    }
    
    public static function boot() {
        parent::boot();
        
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
        });
        
        static::deleted(function($answer) {
            $answer->question->decrement('answers_count');
        });
    }
    
    public function getCreatedDateAttribute() {
        return Carbon::parse($this->created_at)->diffForHumans();       
    }
    
}
