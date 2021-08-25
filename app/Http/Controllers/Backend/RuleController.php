<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rule;
use Carbon\Carbon;
use DB;
use Auth;

class RuleController extends Controller {
    

    
    public function index() {
        $courses= DB::table('course')->get();
        $records = Rule::orderBy('to','asc')->get();
        return view('backend/rule/index', compact('records','courses'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $courses= DB::table('course')->where('is_pro',null)->where('is_online',null)->get();
        $pro_courses =  DB::table('course')->where('is_pro',1)->get();
        $online_courses =  DB::table('course')->where('is_online',1)->get();
        return view('backend/rule/create',compact('courses','pro_courses','online_courses'));
      
    }


    public function store(Request $request) {
        $rule = new Rule();
        $input = $request->all();
        if($request->check){
        $input['courses'] = implode(',',$input['check']);
        }else{
             return Redirect()->back()->with('error','Vui lòng chọn khoá học');
        }
        unset($input['check']);
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');

        $records = DB::table('rule')->get();
        if($input['to'] > 10 || $input['from'] > $input['to']){
             return Redirect()->back()->with('error','Vui lòng nhập lại');
        }

        foreach ($records as $key => $record) {
            if( $record->from >= $input['from']  &&   $record->from <= $input['to']){
                 return Redirect()->back()->with('error','Vui lòng nhập lại');
            }
             if( $record->to >= $input['from']  &&   $record->to <= $input['to']){
                 return Redirect()->back()->with('error','Vui lòng nhập lại');
            }
        }

        $create_score = $rule::create($input);
        if($create_score){
            return redirect()->route('admin.rule.index')->with('success','Thêm mới thành công');
        }
        else{
             return redirect()->route('admin.rule.index')->with('error','Thêm mới thất bại');
        }
    }


    public function edit($id) {
           $record = Rule::find($id);
           if(!$record){
               abort(404);
           }
            $courses= DB::table('course')->where('is_pro',null)->where('is_online',null)->get();
            $pro_courses =  DB::table('course')->where('is_pro',1)->get();
            $online_courses =  DB::table('course')->where('is_online',1)->get();
            return view('backend/rule/edit', compact('record','courses','pro_courses','online_courses'));     
    }


    public function update(Request $request, $id) {

        $rule = new Rule();
        $input = $request->all();
        if($request->check){
        $input['courses'] = implode(',',$input['check']);
        }else{
             return Redirect()->back()->with('error','Vui lòng chọn khoá học');
        }
        unset($input['check']);
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $records = DB::table('rule')->where('id','!=',$id)->get();
        if($input['to'] > 10 || $input['from'] > $input['to']){
             return Redirect()->back()->with('error','Vui lòng nhập lại');
        }

        foreach ($records as $key => $record) {
            if( $record->from >= $input['from']  &&   $record->from <= $input['to']){
                 return Redirect()->back()->with('error','Vui lòng nhập lại');
            }
             if( $record->to >= $input['from']  &&   $record->to <= $input['to']){
                 return Redirect()->back()->with('error','Vui lòng nhập lại');
            }
        }
        $create_score = $rule::find($id)->update($input);
        if($create_score){
            return redirect()->route('admin.rule.index')->with('success','Thêm mới thành công');
        }
        else{
             return redirect()->route('admin.rule.index')->with('error','Thêm mới thất bại');
        }
       
       
       
    }


    public function destroy($id) {
        Rule::destroy($id);
        return redirect()->route('admin.rule.index')->with('success', 'Xóa thành công');
        //
    }

    public function update_multiple(Request $request) {
        $data = $request->all();
        
        if($request->action == "save"){      
           $records = Teacher::orderBy('ordering','desc')->get();
           foreach ($records as $key => $record) {
               if($record->ordering != $data['orderBy'][$key]){
                    DB::table('teacher')->where('id',$record->id)->update(['ordering'=>$data['orderBy'][$key]]);
               }
           }
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
        else{
            if($request->check == null){
            return redirect()->back()->with('error',"Vui lòng chọn ít nhất một giảng viên");
            }

            if($request->action == "delete"){
               foreach($data['check'] as $key => $chk){
                     DB::table('teacher')->where('id',$chk)->delete();
               }  
               return redirect()->back()->with('success',"Xoá thành công");
            }
            elseif($request->action == "active"){
               foreach($data['check'] as $key => $chk){
                     DB::table('teacher')->where('id',$chk)->update(['status'=>1]);
               }  
               return redirect()->back()->with('success',"Cập nhật thành công");
            }else{
                  foreach($data['check'] as $key => $chk){
                     DB::table('teacher')->where('id',$chk)->update(['status'=>0]);
               } 
               } 
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
    }

}


   
