<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {
    protected $table = 'section';
    protected $fillable = [
        'name', 'section_type', 'test_id', 'created_at', 'updated_at','file','section_content','ordering'
    ];
    

    public function validateCreate1() {
        return $rules = [
            'name' => 'required',
            'file'=>'required|mimes:audio/mpeg,mpga,mp3,wav,aac'
        ];
    }

    public function validateCreate2() {
        return $rules = [
            'name' => 'required',
            'section_content'=>'required'
        ];
    }

    public function validateCreate3() {
        return $rules = [
            'name' => 'required',
            'test_id' => 'required'
        ];
    }

    public function validateUpdate1($id) {
        return $rules = [
            'name' => 'required',
            'test_id' => 'required',
            'file'=>'mimes:audio/mpeg,mpga,mp3,wav,aac'

        ];
    }

    public function validateUpdate2($id) {
        return $rules = [
            'name' => 'required',
            'test_id' => 'required',
            'section_content'=>'required'

        ];
    }

      public function validateUpdate3($id) {
        return $rules = [
            'name' => 'required',
            'test_id' => 'required'

        ];
    }
  
}
