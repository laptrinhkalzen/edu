<?php

/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/09/2019
 * Time: 11:03 AM
 */

namespace App\Repositories;

use Repositories\Support\AbstractRepository;

class TestRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Test';
    }

    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:test',
            'alias' => 'required',
            'category_id' => 'required',
            'image'=>'mimes:jpeg,png,jpg'
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:test,title,' . $id . ',id',
            'alias' => 'required',
            'category_id' => 'required',
            'image'=>'mimes:jpeg,png,jpg'
        ];
    }

    public function readFE($request, $limit = 15) {
        $model = $this->model;
        if ($request->get('category_id')) {
            $product_ids = \Db::table('product_category')->where('category_id', $request->get('category_id'))->pluck('product_id');
            $model = $model->whereIn('id', $product_ids);
        }
        if ($request->get('attribute_id')) {
            $attribute_ids = explode(',', $request->get('attribute_id'));
            $product_ids = \Db::table('product_attribute')->whereIn('attribute_id', $attribute_ids)->pluck('product_id');
            $model = $model->whereIn('id', $product_ids);
        }
        if ($request->get('keyword')) {
            $model = $model->where(function ($query) use ($request) {
                return $query->where('title', 'like', '%' . $request->get('keyword') . '%')
                                ->orWhere('content', 'like', '%' . $request->get('keyword') . '%');
            });
        }
        return $model->where('status', 1)->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function allTest() {
        return $this->model->where('status', 1)->get();
    }


}
