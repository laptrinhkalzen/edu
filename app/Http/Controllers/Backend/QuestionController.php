<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use DB;
use Auth;
use Carbon\Carbon;

class QuestionController extends Controller {
	public function index(){
        $records = Question::all();
        $tests = DB::table("test")->where('type', 1)->get(); 
        return view('backend/question/index',compact('records','tests'));
	}

	public function create(){
        
	}

	public function store(Request $request){
		 $input = $request->except('_token');
		 if($input['question_type'] == 1){
		 	 $input['answer'] = $input['list_answer'][$input['is_answer']];
		 	 $input['created_at'] = Carbon::now();
		 	 unset($input['list_answer']);
		 	 unset($input['is_answer']);
             $id = DB::table('question')->insertGetId($input);
             foreach($request->list_answer as $value){
             	$data['answerr'] = $value;
             	$data['question_id'] = $id;
             	$data['answer_type'] = $input['question_type'];
             	$data['created_at'] = Carbon::now();
             	DB::table('answer')->insert($data);
             }
		 }
		 elseif ($input['question_type'] == 3) {
		 	  dd($input);
		 }
		 return redirect()->route('admin.question.index');
	}

	public function edit($id){
        $records = DB::table('question')->where('test_id',$test_id)->get();
        return view('backend/question/edit',compact('records'));
	}

	public function update(Request $request,$id){
		$input = $request->except('_token');
        if($input['question_type'] == 1 || $input['question_type'] == 4){
        	if($request->answer_radio == null){
        		return redirect()->back()->with('error','Vui lòng chọn 1 đáp án');
        	}
        	$input['answer'] = $input['list_answer'][$input['answer_radio']];
            $input['list_answer'] = implode(',',$input['list_answer']);
	        
	        unset($input['answer_radio']);
        }
        DB::table('question')->where('id',$id)->update($input);
        return redirect()->back()->with('success','Cập nhật thành công');
    }
	

}


