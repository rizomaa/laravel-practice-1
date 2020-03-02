<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;  

class Question extends Model
{
    use VotableTrait;
    
    protected $fillable = ['title', 'body'];
    
    protected $appends = ['created_date'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function getUrlAttribute() {
        return route('questions.show', $this->slug);
    }
    
    public function getCreatedDateAttribute() {
        return Carbon::parse($this->created_at)->diffForHumans();       
    }
    
    public function getStatusAttribute() {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return 'answered-accepted';
            }
            return 'answered';
        }
        return 'unanswered';
    }
    
   /* public function setBodyAttribute($value) {
        $this->attributes['body'] = $value;
        // needs to add clean();
    }*/
    
    //such a function called as an accessor
    public function getBodyHtmlAttribute() {
        return clean($this->bodyHtml());
     //   return $this->bodyHtml();
    }
    
    public function answers() {
        // if it necessary to use the sorting method in all placeses also better to use sorting in a perticular provider
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');
    }
    
    public function acceptBestAnswer(Answer $answer) {
        $this->best_answer_id = $answer->id;
        $this->save();
    }
        
    public function favorites() {
        return $this->belongsToMany(User::class, 'favorites', 'question_id')->withTimestamps();//, 'user_id');//, 'user_id', 'question_id');
    }
    
    public function isFavorited() {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
        
    }
    
    public function getIsFavoritedAttribute() {
        return $this->isFavorited();
    }
    
    public function getFavoritesCountAttribute() {
        return $this->favorites()->count();
    }
    
    public function getExerptAttribute() {
        return $this->exerpt(250);
    }
    
    private function bodyHtml() {
        return clean(\Parsedown::instance()->text($this->body));
    }
    
    public function exerpt($length) {
        return Str::limit(strip_tags($this->bodyHtml()), $length);
    }
}

















