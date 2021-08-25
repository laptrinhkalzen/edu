<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizz extends Model {

    //
    protected $table = "quizz";
    protected $fillable = [
        'title', 'image', 'type_quizz', 'content', 'orderBy','created_at', 'updated_at','section_id','section_type'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

}
