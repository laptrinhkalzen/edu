<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = "news_category";
    protected $fillable = [
        'news_id', 'category_id'
    ];
}
