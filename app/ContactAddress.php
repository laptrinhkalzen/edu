<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model {
    protected $table = 'contact_address';
    protected $fillable = [
        'name', 'address', 'city', 'created_at', 'updated_at','phone_1','phone_2','ordering','status','map','created_at','updated_at'
    ];
    

    public function validateCreate() {
        return $rules = [
            'name' => 'required|unique:contact_address'
        ];
    }

     public function validateUpdate($id) {
        return $rules = [
            'name' => 'required',
        ];
    }

   
  
}
