<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;

class UpdateStatus extends Controller
{
    public function updateTeacherStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=='Active'){  
                $status=0;
            }else{
                $status=1;
            }

            Teacher::where('id', $data['id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['id']]);
        }
    }
}
