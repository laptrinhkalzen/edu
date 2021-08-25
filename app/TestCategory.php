<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestCategory extends Model
{
    protected $table = "test_category";
    protected $fillable = [
        'test_id', 'category_id'
    ];
}
