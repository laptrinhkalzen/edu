<?php

namespace App\Repositories;

use Repositories\Support\AbstractRepository;
use App\ContactAddress;
class ContactAddressRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\ContactAddress';
    }
    public function validateCreate() {
        return $rules = [
            'name' => 'required',
        
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'name' => 'required',
            
        ];
    }
}
