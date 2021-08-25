<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model {
    protected $table = 'test';
    protected $fillable = [
        'title', 'type', 'category_id', 'created_at', 'updated_at','alias','image','status','note','ordering'
    ];

    public function categories() {
        return $this->belongsToMany('\App\Category', 'test_category', 'test_id', 'category_id');
    }

    public function getImage() {
        $image_arr = explode(',', $this->images);
        return $image_arr[0];
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }
}
