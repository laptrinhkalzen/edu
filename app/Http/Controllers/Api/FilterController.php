<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use DB;
use Carbon\Carbon;

class FilterController extends Controller {




    public function filter_news_cat(Request $request) {
        $cat_id = $request->get('car_id');
        $cat_id = DB::table('news_category')->where('category_id',$cat_id)->get()->pluck('news_id');
        $records = DB::table('news')->whereIn('id',$cat_id)->get();
        $categories = DB::table('category')->where('type',2)->get();
        return view('backend/news/index', compact('records','categories'));
    }

}
