<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TestRepository;
use Repositories\NewsRepository;
use App\Repositories\ContactRepository;
use Repositories\ConfigRepository;



class BackendController  extends Controller
{
    

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $product_count = 1;
        $news_count = 1;
        $contact_count = 1;
        return view('backend/index', compact('product_count', 'news_count', 'contact_count'));
    }


}