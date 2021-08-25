<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quizz;
use DB;
use Auth;
use Carbon\Carbon;

class QuizzController extends Controller {
	public function index(){
        $records = Quizz::join('section','quizz.section_id','=','section.id')->select('*','quizz.id as id')->orderBy('quizz.orderBy','desc')->get();
        $questions = DB::table('question')->get();

        return view('backend/quizz/index',compact('records','questions'));
	}

	public function create(Request $request){
		$type = $request->type;
        $tests = DB::table('test')->get();
        $sections = DB::table('section')->get();
		if($type==1){
            
			return view('backend/quizz/create',compact('type','tests','sections'));
		}
		else{
			return view('backend/quizz/create',compact('type','tests','sections'));
		}
        return view('backend/quizz.create',compact('type'));
	}

	public function store(Request $request){
		$input = $request->except('_token');
        $input['section_type'] = DB::table('section')->where('id',$input['section_id'])->pluck('section_type')->first();
		 $id = DB::table('quizz')->insertGetId($input);
		 return redirect()->route('admin.quizz.index')->with('success',"Lưu thành công");
	}

	public function edit($id){
        $record = DB::table('quizz')->where('id',$id)->first();
        if($record){
	        $tests = DB::table('test')->get();
	        $questions = DB::table('question')->where('quizz_id',$id)->orderBy('ordering','asc')->get();
	        return view('backend/quizz/edit',compact('record','tests','questions'));
	    }else{
	    	abort(404);
	    }
	}

	public function update(Request $request,$id){
		$input = $request->except('_token');
		 Quizz::find($id)->update($input);
		 return redirect()->route('admin.quizz.index')->with('success',"Cập nhật thành công");;
	}

	public function destroy($id){
        DB::table('quizz')->where('id',$id)->delete();

        DB::table('question')->where('quizz_id',$id)->delete();
        return redirect()->back()->with('success','Xoá thành công');
	}

}


