<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ItemRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Item';
    }

    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:item',
            'alias' => 'required',
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:item,title,' . $id . ',id',
            'alias' => 'required',
        ];
    }

    public function readFE() {
        return $this->model->where('status', 1)->orderBy('ordering', 'asc')->get();
    }

}
