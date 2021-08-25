<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 18/10/2019
 * Time: 4:05 PM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class VideoCategoryRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\VideoCategory';
    }

    public function getVideoIds($category_ids)
    {
        return $this->model->whereIn('category_id', $category_ids)->pluck('video_id');
    }

}