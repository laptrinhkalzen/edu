<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 11/09/2019
 * Time: 3:37 PM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class ServiceRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Service';
    }
    public function validateCreate() {
        return $rules = [
            'title' => 'required',
            'alias' => 'required',
            'image' => 'required',
        ];
    }
    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required',
            'alias' => 'required',
        ];
    }

}