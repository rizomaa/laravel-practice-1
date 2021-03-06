<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $appends = [
        'url', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function questions() {
        return $this->hasMany(Question::class);
    }
    
    public function getUrlAttribute() {
        //return route('question.show', $this->id);
        return '#';
    }
    
    public function answers() {
        return $this->hasMany(Answer::class);
    }
    
    public function posts() {
        $type = request()->get('type');
        
        if ($type === 'questions') {
            $posts = $this->questions()->get();//we can add also paginate method
        } else {
            $posts = $this->answers()->with('question')->get();
            
            if ($type !== 'answers') {
                $post2 = $this->questions()->get();
                
                $posts = $posts->merge($post2);
            }            
        }
        
        $data = collect();
        
        foreach($posts as $post) {
            $item = [
                'votes_count'   => $post->votes_count,
                'created_at'    => $post->created_at->format('M d Y')
            ];
            
            if ($post instanceof Answer) {
                
                $item['type'] = 'A';
                
                $item['title'] = $post->question->title;
                
                $item['accepted'] = $post->question->best_answer_id === $post->id ? true : false;
                
            } elseif ($post instanceof Question) {
                $item['type'] = 'Q';
                $item['title'] = $post->title;
                $item['accepted'] = (bool)$post->best_answer_id;
            }
            
            $data->push($item);
        }
        
        
        return $data->sortByDesc('votes_count')->values()->all();
    }
    
    public function getAvatarAttribute(){
        $email = $this->email;
        $size = 40;
        
        return $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
    
    public function favorites() {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();//, 'user_id', 'question_id');
    }
    
    
    //relationship method
    public function voteQuestions() {
        return $this->morphedByMany(Question::class, 'votable'); // The Eloquent will recognise a table name as `votables`
    }
    
    public function voteAnswers() {
        return $this->morphedByMany(Answer::class, 'votable'); // The Eloquent will recognise a table name as `votables`
    }
    
    //custom method that places all vote logic
    public function voteQuestion(Question $question, $vote) {
        $voteQuestions = $this->voteQuestions();
        return $this->_vote($voteQuestions, $question, $vote);
    }
    
    public function voteAnswer(Answer $answer, $vote) {
        $voteAnswers = $this->voteAnswers();
        return $this->_vote($voteAnswers, $answer, $vote);
    }
    
    private function _vote($relationship, $model, $vote) {
        if ($relationship->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        } else {
            $relationship->attach($model, ['vote' => $vote]);
        }
        
        $model->load('votes'); // here was just votes, but I think we need votes_count because we modified the column
        
        $downVotes = (int) $model->downVotes()->sum('vote');
        $upVotes = (int) $model->upVotes()->sum('vote');
        
        // downVotes = votes()->wherePivot('vote', -1)  
        
        $model->votes_count = $upVotes + $downVotes;
        $model->save();
        
        return $model->votes_count;
    }
    
}
    














