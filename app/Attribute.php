<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $table = 'attribute';

    const TYPE_SELECT = 'select';
    const TYPE_TEXT = 'text';
    const MODULE_PRODUCT = 'product';
    const MODULE_GALLERY = 'gallery';

    protected $fillable = [
        'title', 'parent_id', 'type', 'module'
    ];
    public $timestamps = false;

    public function products() {
        return $this->belongsToMany('\App\Product', 'product_attribute', 'attribute_id', 'product_id');
    }

    public function galleries() {
        return $this->belongsToMany('\App\Gallery', 'gallery_attribute', 'attribute_id', 'gallery_id');
    }

}
