<?php

namespace Repositories;

use App\Product;
use Illuminate\Support\Facades\DB;
use Repositories\Support\AbstractRepository;

class VideoRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Video';
    }
    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:video',
            'alias' => 'required',
            'video_url' => 'required'
        ];
    }
    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:video,title,'.$id.',id',
            'alias' => 'required',
            'video_url' => 'required'
        ];
    }

    public function readFE($limit = 15) {
        return $this->model->where('status', 1)->orderBy('created_at', 'desc')->paginate($limit);
    }
    public function readSearch($request,$limit = 15) {
        $model = $this->model;
        if ($request->get('category_id')) {
            $video_ids = \Db::table('video_category')->where('category_id', $request->get('category_id'))->pluck('video_id');
            $model = $model->whereIn('id', $video_ids);
        }
        if ($request->get('keyword')) {
            $model = $model->where(function ($query) use ($request) {
                return $query->where('title', 'like', '%' . $request->get('keyword') . '%')
                    ->orWhere('content', 'like', '%' . $request->get('keyword') . '%');
            });
        }
        return $model->where('status', 1)->orderBy('created_at', 'desc')->paginate($limit);
    }
    public function readHotVideoArr($limit)
    {
        return $this->model->where('status',1)->where('is_hot',1)->orderBy('created_at', 'desc')->take($limit)->get();
    }
    public function findByAlias($alias){
        return $this->model->where('alias','=',$alias)->first();
    }
    public function getRelatedVideo($limit = 8, $category )
    {
        $video_ids = \DB::table('video_category')->where('category_id', $category->id)->pluck('video_id');
        return $this->model->where('status', 1)->whereIn('id', $video_ids)->orderBy('created_at', 'desc')->take($limit)->get();
//        return $this->model->where('status', 1)->where('id','<>', $current_id)->whereIn('id', $video_ids)->take($limit)->get();
    }
    public function getRelatedProduct($keyword_arr)
    {
        foreach ($keyword_arr as $key=>$item)
        {
            $related_products = Product::where('title','like', '%'.$item.'%')->get();
        }
        return $related_products;
    }
}