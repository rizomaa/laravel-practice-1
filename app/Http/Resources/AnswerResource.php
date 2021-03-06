<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'votes_count'   => $this->votes_count,
            'is_best'       => $this->is_best,
            'question_id'   => $this->question_id,
            'created_date'  => $this->created_date,
            'body'          => $this->body,
            'body_html'     => $this->body_html,
            'user'          => new UserResource($this->user),
            'question_user_id' => $this->question->user_id
        ];
    }
}
