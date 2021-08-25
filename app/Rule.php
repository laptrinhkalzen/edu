<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model {

    //
    protected $table = "rule";
    protected $fillable = [
        'from', 'to', 'courses','created_at','updated_at'
    ];
}
