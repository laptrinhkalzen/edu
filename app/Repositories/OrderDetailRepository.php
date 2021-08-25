<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/09/2019
 * Time: 11:02 AM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class OrderDetailRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\OrderDetail';
    }
}