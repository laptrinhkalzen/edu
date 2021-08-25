<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use DB;

class QuestionController extends Controller {

    public function create_question(Request $request) {
        $input = $request->all();
        if($input['question_type'] == 1){
	        $input['list_answer'] = implode(',',$input['data']);
	        $input['answer'] = $input['data'][$input['radioValue']];
	        unset($input['data']);
            unset($input['true_false']);
	        unset($input['radioValue']);
	        $id = DB::table('question')->insertGetId($input);

	        $record= DB::table('question')->where('id',$id)->first();
        }elseif($input['question_type'] == 2){
        	unset($input['data']);
            unset($input['true_false']);
        	$id = DB::table('question')->insertGetId($input);
	        $record= DB::table('question')->where('id',$id)->first();
        }
        elseif($input['question_type'] == 3){
           $data['question_type'] =  $input['question_type'];
            $data['question'] = $input['question'];
            $data['quizz_id']= $input['quizz_id'];
            $data['answer']= $input['true_false'];
             $data['ordering']= $input['ordering'];
            $id = DB::table('question')->insertGetId($data);
            $record= DB::table('question')->where('id',$id)->first();
        }
         elseif($input['question_type'] == 4){
            
            $input['list_answer'] = implode(',',$input['data']);
            $input['answer'] = $input['data'][$input['radioValue']];
            unset($input['data']);
            unset($input['radioValue']);
            unset($input['question']);
            unset($input['true_false']);
            $id = DB::table('question')->insertGetId($input);

            $record= DB::table('question')->where('id',$id)->first();
        }
         elseif($input['question_type'] == 5){
            $data['question_type'] =  $input['question_type'];
            $data['ordering']= $input['ordering'];
            $data['question'] = $input['question'];
            $data['quizz_id']= $input['quizz_id'];
            $data['answer']= $input['data'];
            $id = DB::table('question')->insertGetId($data);
            $record= DB::table('question')->where('id',$id)->first();
        }
        return response()->json(array('success' => true,'record'=>$record));
    }

        public function update_question(Request $request) {
        $input = $request->all();
        if($input['question_type'] == 1){
            $input['list_answer'] = implode(',',$input['data']);
            $input['answer'] = $input['data'][$input['radioValue']];
            unset($input['data']);
            unset($input['true_false']);
            unset($input['radioValue']);
            $id = DB::table('question')->insertGetId($input);

            $record= DB::table('question')->where('id',$id)->first();
        }elseif($input['question_type'] == 2){
            unset($input['data']);
            unset($input['true_false']);
            $id = DB::table('question')->insertGetId($input);
            $record= DB::table('question')->where('id',$id)->first();
        }
        elseif($input['question_type'] == 3){
           $data['question_type'] =  $input['question_type'];
            $data['question'] = $input['question'];
            $data['quizz_id']= $input['quizz_id'];
            $data['answer']= $input['true_false'];
             $data['ordering']= $input['ordering'];
            $id = DB::table('question')->insertGetId($data);
            $record= DB::table('question')->where('id',$id)->first();
        }
         elseif($input['question_type'] == 4){
            
            $input['list_answer'] = implode(',',$input['data']);
            $input['answer'] = $input['data'][$input['radioValue']];
            unset($input['data']);
            unset($input['radioValue']);
            unset($input['question']);
            unset($input['true_false']);
            $id = DB::table('question')->insertGetId($input);

            $record= DB::table('question')->where('id',$id)->first();
        }
         elseif($input['question_type'] == 5){
            $data['question_type'] =  $input['question_type'];
            $data['ordering']= $input['ordering'];
            $data['question'] = $input['question'];
            $data['quizz_id']= $input['quizz_id'];
            $data['answer']= $input['data'];
            $id = DB::table('question')->insertGetId($data);
            $record= DB::table('question')->where('id',$id)->first();
        }
        return response()->json(array('success' => true,'record'=>$record));
    }

    
}
