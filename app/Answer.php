<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

    //
    protected $table = "answer";
    protected $fillable = [
        'question_id', 'answerr', 'answer_type', 'created_at', 'updated_at'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

}
