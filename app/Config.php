<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {

    protected $table = 'config';
    protected $fillable = [
        'title', 'company_name', 'description', 'keywords', 'content', 'facebook', 'tiktok', 'instagram', 'fanpage', 'youtube', 'youtube_channel', 'mst', 'image','favicon','template','statistic','about'
    ];
    public $timestamps = false;
}
