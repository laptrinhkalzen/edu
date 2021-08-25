<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

    //
    protected $table = "teacher";
    protected $fillable = [
        'name', 'nickname', 'avatar' , 'phone','birthday', 'sex','email' ,'summary' ,'ordering', 'content' , 'status','created_at','updated_at'
    ];
    

    public function validateCreate() {
        return $rules = [
            'name' => 'required',
            'avatar' => 'mimes:jpeg,jpg,png'
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'name' => 'required',
            'avatar' => 'mimes:jpeg,jpg,png'
       
        ];
    }
    
    public function getImage() {
        $image_arr = explode(',', $this->images);
        return $image_arr[0];
    }

    public function created_at() {
        return date('d/m/Y', strtotime($this->created_at));
    }

    

}
