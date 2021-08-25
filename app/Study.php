<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model {
    protected $table = 'study';
    protected $fillable = [
        'name', 'alias', 'created_at', 'updated_at','image','avatar','is_best','ordering','status','point','summary','content'
    ];
    

    public function validateCreate() {
        return $rules = [
            'name' => 'required|unique:best',
            'point'=>'required',
            'summary' =>'required',
            "avatar" => "required|mimes:jpg,png,jpeg|max:10000"
        ];
    }

   

    public function validateUpdate($id) {
        return $rules = [
            'name' => 'required|unique:best,name,' . $id . ',id',
            'point'=>'required',
            'summary' =>'required',
            "avatar" => "mimes:jpg,png,jpeg|max:10000"
        ];
    }
  
}
