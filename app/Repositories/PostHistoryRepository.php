<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class PostHistoryRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\PostHistory';
    }

    public function readRecentPost($page = 0, $limit = 10) {
        $data = $this->model->where('module', '!=', 'news')->orderBy('updated_at', 'desc')->skip($page * $limit)->take($limit)->get();
        return $data;
    }

    public function findByItemId($item_id, $module = 'product') {
        return $this->model->where('module', $module)->where('item_id', $item_id)->first();
    }

}
