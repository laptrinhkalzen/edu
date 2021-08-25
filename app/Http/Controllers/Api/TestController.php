<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class TestController extends Controller {
  

    public function pickTest(Request $request) {
     
    }

    public function selectTest(Request $request) {
         $sections = DB::table('section')->where('test_id',$request->test_id)->get();
         if($sections){
            return response()->json(['success'=>1, 'sections'=>$sections]);
         }else{
             return response()->json(['success'=>0]);
         }
    }





}
