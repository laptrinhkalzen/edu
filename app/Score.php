<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model {

    //
    protected $table = "score";
    protected $fillable = [
        'from', 'to', 'score','content','type','status','created_at','updated_at'
    ];
}
