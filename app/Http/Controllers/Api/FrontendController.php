<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Auth;
use Repositories\ReviewPersonRepository;
use Mail;
use DB;

class FrontendController extends Controller {

 

       public function sign_up_advise(Request $request){
            $input = $request->all();
            $res = DB::table('contact')->create($input);
            if($res){
                return response()->json(['success'=>1]);
            }
            else{
                 return response()->json(['success'=>0]);
            }
       }

        public function update_promo(Request $request){
            $input = $request->all();
            DB::table('course')->where('id',$input['id'])->update(['price'=>$input['price'],'sale_price'=>$input['sale_price'],'sale_time'=>$input['sale_time']]);

                return response()->json(['success'=>1]);
       }

       public function get_schedule (request $request){
            $input = $request->all();
            if($input['course_id'] == "pro"){
               $course_id = DB::table('course')->where('is_pro',1)->get()->pluck('id');
               $schedules = DB::table('schedule')->whereIn('course_id',$course_id)->get();
            }elseif($input['course_id'] == "online"){
               $course_id = DB::table('course')->where('is_online',1)->get()->pluck('id');
               $schedules = DB::table('schedule')->whereIn('course_id',$course_id)->get();
            }else{
               $schedules = DB::table('schedule')->where('course_id',$input['course_id'])->get();
            }
            $html = "";
            foreach($schedules as $schedule){
                 $html .= "<option value=".$schedule->id.">".$schedule->title."</option>"; 
            }
            return $html;
       }
 
}
