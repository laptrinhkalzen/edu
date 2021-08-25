<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/09/2019
 * Time: 10:39 AM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class MemberRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Member';
    }
}