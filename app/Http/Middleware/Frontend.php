<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Frontend {
    public function handle($request, Closure $next){
        $config = \DB::table('config')->first();
        //$menu = \DB::table('menu')->get();
        $menu = \DB::table('menu')->where('status',1)->orderBy('ordering','asc')->where('parent_id', 0)->get();
        foreach($menu as $key=>$val){
            $menu[$key]->children = \DB::table('menu')->where('status',1)->where('parent_id',$val->id)->orderBy('ordering','asc')->get();
        }
        $template_setting= \DB::table('template_setting')->get();
        $news_footer = \DB::table('news')->where('status',1)->orderBy('ordering','desc')->limit(5)->get();
        $news_footer2 = \DB::table('news')->join('news_category', 'news.id', '=', 'news_category.news_id')->where('news_category.category_id',239)->where('status',1)->select('news.*')->orderBy('news.ordering')->get();
        $block = \DB::table('block')->where('status',1)->orderBy('ordering','desc')->get();
        $course_shares = \DB::table('course')->where('status',1)->where('is_pro',null)->where('is_online',null)->orderBy('ordering','asc')->get();
        $contact_address = \DB::table('contact_address')->orderBy('ordering','asc')->where('status', 1)->get();
        $banner = \DB::table('banner')->get();
        $contact_address_footer = \DB::table('contact_address')->where('city',1)->where('status',1)->orderBy('ordering','asc')->get();
        \View::share(['contact_address_footer' => $contact_address_footer]);
        \View::share(['config' => $config]);
        \View::share(['banner' => $banner]);
        \View::share(['menu' => $menu]);
        \View::share(['news_footer' => $news_footer]);
        \View::share(['news_footer2' => $news_footer2]);
        \View::share(['template' => $template_setting]);
        \View::share(['block' => $block]);
        \View::share(['contact_address' => $contact_address]);
        \View::share(['course_shares' => $course_shares]);
        return $next($request);
    }
    
}
