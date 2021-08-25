<?php


namespace App\Repositories;

use Repositories\Support\AbstractRepository;

class BlockRepository extends AbstractRepository{

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Block';
    }
    public function validate(){
        return $rules = [
            'title' => 'required',
            'image' => 'mimes:jpg,png,jpeg'
            
        ];
    }

}
