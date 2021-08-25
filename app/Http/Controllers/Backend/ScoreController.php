<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Score;
use Carbon\Carbon;
use DB;
use Auth;

class ScoreController extends Controller {
    

    
    public function index() {
   
        $records = Score::orderBy('type','asc')->orderBy('created_at','asc')->get();
        return view('backend/score/index', compact('records'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type) {
       
        return view('backend/score/create',compact('type'));
      
    }


    public function store(Request $request,$type) {
        $score = new Score();
        $input = $request->all();
        $input['type'] = $type;

        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if(isset($input['status'])){
            $input['status'] = 1;
        }else{
            $input['status'] = 0;
        }
       
        // $min = DB::table('score')->where('type',$type)->max('to') +1;
        $max = DB::table('quizz')->join('section','section.id','=','quizz.section_id')->join('question','question.quizz_id','=','quizz.id')->count();

        if($max == null){
             return Redirect()->back()->with('error','Vui lòng nhập thêm câu hỏi');
        }
      
        if($input['to'] > $max || $input['from'] > $input['to']){
             return Redirect()->back()->with('error','Vui lòng nhập lại');
        }

        $records = DB::table('score')->where('type',$type)->get();

        foreach ($records as $key => $record) {
            if( $record->from >= $input['from']  &&   $record->from <= $input['to']){
                 return Redirect()->back()->with('error','Vui lòng nhập lại');
            }
             if( $record->to >= $input['from']  &&   $record->to <= $input['to']){
                 return Redirect()->back()->with('error','Vui lòng nhập lại');
            }
        }
        

        $create_score = $score::create($input);
        if($create_score){
            return redirect()->route('admin.section.index')->with('success','Thêm mới thành công');
        }
        else{
             return redirect()->route('admin.section.index')->with('error','Thêm mới thất bại');
        }
    }


    public function edit($id) {
     
           $record = Score::find($id);
           if(!$record){
               abort(404);
           }
            
        
           return view('backend/score/edit', compact('record'));
            
            
    }


    public function update(Request $request, $id) {

        $score = new Score();
        $input = $request->all();


        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if(isset($input['status'])){
            $input['status'] = 1;
        }else{
            $input['status'] = 0;
        }
       
        $record = Score::find($id);
        $records = DB::table('score')->where('type',$record->type)->get();
        
        foreach ($records as $key => $record) {
            if($record->id == $id){
                unset($records[$key]);
            }
        }
        $max = DB::table('quizz')->join('section','section.id','=','quizz.section_id')->join('question','question.quizz_id','=','quizz.id')->count();

        if($max == null){
             return Redirect()->back()->with('error','Vui lòng nhập thêm câu hỏi');
        }
      
        if($input['to'] > $max || $input['from'] > $input['to']){
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

        $create_score = $score::find($id)->update($input);
        if($create_score){
            return redirect()->route('admin.section.index')->with('success','Cập nhật thành công');
        }
        else{
             return redirect()->route('admin.section.index')->with('error','Cập nhật thất bại');
        }
       
    }


    public function destroy($id) {
        Score::destroy($id);
        return redirect()->route('admin.section.index')->with('success', 'Xóa thành công');
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


    // public function store(Request $request) {
    //     $teacher = new Teacher();
    //     $degree = new Degree();
    //     $input = $request->except(['title','image']);
    //     $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
    //     if(isset($input['status'])){
    //         $input['status'] = 1;
    //     }else{
    //         $input['status'] = 0;
    //     }
    //     $title_degree = $request->title;
    //     $image_degree = $request->image;
    //     $input_degrees = array();
    //     for($i = 0; $i< count($title_degree) ; $i++){
    //         $input_degrees[$i]['title'] = $title_degree[$i];
    //         $input_degrees[$i]['image']= $image_degree[$i];
    //     }
    //     $validator = \Validator::make($input, $teacher->validateCreate());
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     foreach($input_degrees as $input_degree){
    //     $validator_degree = \Validator::make($input_degree, $degree->validateCreate());
    //     if ($validator_degree->fails()) {
    //         return redirect()->back()->with('error','Chỉ cho phép upload file có dạng jpg,png,jpeg');
    //     }
    //     }
    //     $create_teacher = $teacher::create($input);
    //     $id = $create_teacher->id;
    //     if($create_teacher){
    //         foreach($input_degrees as $input_degree){
    //              $input_degree['teacher_id'] = $id;
    //             DB::table('degree')->insert($input_degree);
    //         }
    //     }
       
    //     if($create_teacher){
    //         return redirect()->route('admin.teacher.index')->with('success','Thêm mới thành công');
    //     }
    //     else{
    //          return redirect()->route('admin.teacher.index')->with('error','Thêm mới thất bại');
    //     }
    // }
