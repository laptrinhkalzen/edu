<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class TeacherRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Teacher';
    }
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
    
   

}
