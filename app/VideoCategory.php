<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    protected $table = "video_category";
    protected $fillable = [
        'video_id', 'category_id'
    ];
}
