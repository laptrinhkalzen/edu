<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    protected $table = 'schedule';
    protected $fillable = [
        'title', 'alias', 'contact_address_id', 'created_at', 'updated_at','course_id','schedule','schedule_detail','opening','alias','status','ordering','type'
    ];
    

    public function validateCreate() {
        return $rules = [
            'title' => 'required',
            'alias' => 'required',
            'course_id' => 'required',
            'contact_address_id'=>'required',
            'schedule'=>'required',
            'schedule_detail'=>'required',
            'opening'=>'required'
        ];
    }

   

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:schedule,title,' . $id . ',id',
            'alias' => 'required',
            'course_id' => 'required',
            'contact_address_id'=>'required',
            'schedule'=>'required',
            'schedule_detail'=>'required',
            'opening'=>'required'
        ];
    }
  
}
