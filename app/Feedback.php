<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model {
    protected $table = 'feedback';
    protected $fillable = [
        'name', 'alias', 'type', 'created_at', 'updated_at','image','link_video','ordering','status','course_id'
    ];
    

    public function validateCreate() {
        return $rules = [
            'name' => 'required|unique:feedback',
            'alias' => 'required|unique:feedback'
        ];
    }

   

    public function validateUpdate($id) {
        return $rules = [
            'name' => 'required|unique:feedback,name,' . $id . ',id',
            'alias' => 'required|unique:feedback,alias,' . $id . ',id'

        ];
    }
  
}
