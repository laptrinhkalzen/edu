<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $fillable = [
        'title', 'alias', 'video_url', 'description', 'content', 'meta_title', 'meta_keywords', 'meta_description', 'is_hot','is_simon', 'status', 'ordering', 'keywords', 'images', 'created_by', 'post_schedule'
    ];
    public function getPostSchedule(){
        return date('d/m/Y', strtotime($this->post_schedule));
    }
    public function url() {
        return route('video.detail', ['alias' => $this->alias]);
    }
    public function categories(){
        return $this->belongsToMany('App\Category', 'video_category', 'video_id', 'category_id');
    }
    public function getImage() {
        $image_arr = explode(',', $this->images);
        return $image_arr[0];
    }
    public function getVideo($url)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = $match[1];
        return $youtube_id;
    }
}
