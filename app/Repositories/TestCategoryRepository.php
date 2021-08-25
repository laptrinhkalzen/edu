<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/10/2019
 * Time: 4:40 PM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class TestCategoryRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\TestCategory';
    }
    public function getCategory($category_arr)
    {
        return $this->model->whereIn('category_id', $category_arr->pluck('id'))->orderBy('category_id', 'desc')->first();
    }
}