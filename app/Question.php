<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    //
    const choice =  1;
    const input_question =  2;
    const multiple_choice =  3;

    protected $table = "question";
    protected $fillable = [
        'question', 'quizz_id', 'answer', 'list_answer', 'question_type','created_at', 'updated_at','status'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

}
