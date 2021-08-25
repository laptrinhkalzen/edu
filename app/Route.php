<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model {

    //
    protected $table = "route";
    protected $fillable = [
        'title', 'alias', 'summary', 'status', 'meta_title', 'meta_keywords', 'meta_description', 'ordering', 'ordering','content', 'course_for', 'image','course_profit','promotion','promotion_time', 'created_at','updated_at','level','price','sale_price','sale_time','teacher_id','study_id','is_pro','is_online','video_id'
    ];

     public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:route',
            'alias' => 'required'
           
        ];
    }
    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:route,title,' . $id . ',id',
            'alias' => 'required'
        ];
    }

    public function getImage() {
        $image_arr = explode(',', $this->images);
        return $image_arr[0];
    }

    public function created_at() {
        return date('d/m/Y', strtotime($this->created_at));
    }

   

}
