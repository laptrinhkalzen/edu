<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class GalleryRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Gallery';
    }

    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:project',
            'alias' => 'required',
            'category_id' => 'required',
            'images' => 'required',
            'keywords' => 'required'
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:project,title,' . $id . ',id',
            'alias' => 'required',
            'category_id' => 'required',
            'images' => 'required',
            'keywords' => 'required'
        ];
    }

    public function readFE($request) {
        $limit = 18;
        $model = $this->model;
        if ($request->get('category_id')) {
            $gallery_ids = \Db::table('gallery_category')->where('category_id', $request->get('category_id'))->pluck('gallery_id');
            $model = $model->whereIn('id', $gallery_ids);
        }
        if ($request->get('attribute_id')) {
            $attribute_ids = explode(',', $request->get('attribute_id'));
            $gallery_ids = \Db::table('gallery_attribute')->whereIn('attribute_id', $attribute_ids)->pluck('gallery_id');
            $model = $model->whereIn('id', $gallery_ids);
        }
        if ($request->get('keyword')) {
            $model = $model->where(function ($query) use ($request) {
                return $query->where('title', 'like', '%' . $request->get('keyword') . '%')
                                ->orWhere('content', 'like', '%' . $request->get('keyword') . '%');
            });
        }
        return $model->where('status', 1)->where('created_by', '>', 0)->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function readRelatedGalleries($current_id, $category_ids, $limit = 12) {
        $gallery_ids = \Db::table('gallery_category')->whereIn('category_id', $category_ids)->pluck('gallery_id');
        return $this->model->where('status', 1)->where('id', '<>', $current_id)->whereIn('id', $gallery_ids)->take($limit)->get();
    }

    public function getPreviousGallery($current_id) {
        return $this->model->where('id', '>', $current_id)->where('project_id', 0)->orderBy('id', 'asc')->first();
    }

    public function getNextGallery($current_id) {
        return $this->model->where('id', '<', $current_id)->where('project_id', 0)->orderBy('id', 'desc')->first();
    }

    public function getPreviousGalleryByProject($project_id, $current_id) {
        return $this->model->where('id', '>', $current_id)->where('project_id', $project_id)->orderBy('id', 'asc')->first();
    }

    public function getNextGalleryByProject($project_id, $current_id) {
        return $this->model->where('id', '<', $current_id)->where('project_id', $project_id)->orderBy('id', 'desc')->first();
    }

    public function getImageByKeyword($keywords, $limit = 15) {
        $keyword = explode(',', $keywords);
        $query = $this->model->where('status', 1);
        $query = $query->where(function($que) use($keyword) {
            foreach ($keyword as $key => $val) {
                $que = $que->orWhere('title', 'LIKE', '%' . trim($val) . '%');
            }
            return $que;
        });
        $data = $query->select('images', 'title')->take($limit)->get();
        return $data;
    }

    public function getImageByProject($project_id, $id) {
        $data = $this->model->where('project_id', $project_id)->where('project_id', '>', 0)->where('id', '<>', $id)->get();
        return $data;
    }

    public function deleteByProject($id) {
        $this->model->where('project_id', $id)->delete();
    }

}
