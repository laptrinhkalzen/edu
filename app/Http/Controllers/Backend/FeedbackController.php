<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feedback;
use DB;
use Carbon\Carbon;

class FeedbackController extends Controller {



    public function index(Request $request,$type) {
        $records = DB::table('feedback')->where('type',$type)->orderBy('ordering','desc')->get();
        return view('backend/feedback/index', compact('records','type'));
    }


    public function create($type) {
        if($type == 1){
           $count_ordering =DB::table('feedback')->where('type',1)->count();
        }else{
           $count_ordering =DB::table('feedback')->where('type',2)->count();
        }
        $courses = DB::table('course')->get();
        return view('backend/feedback/create', compact('count_ordering','courses','type'));
    }

    public function store(Request $request) {
        $feedback = new Feedback();
        $input = $request->all();
        $validator = \Validator::make($input, $feedback->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $get_image = $request->image;
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/images/',$new_image);
            $input['image'] = '/upload/images/'.$new_image;
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh'); 
        $res = $feedback->create($input);   
        if ($res) {
            return redirect()->route('admin.feedback.index',$input['type'])->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.feedback.index',$input['type'])->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $id) {
        $record = Feedback::find($id);
        if($record){
        $courses = DB::table('course')->get();
        return view('backend/feedback/edit', compact('record','courses','type'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $feedback = new Feedback();
        $input = $request->all();
        $validator = \Validator::make($input, $feedback->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $get_image = $request->image;
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/images/',$new_image);
            $input['image'] = '/upload/images/'.$new_image;
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh'); 
        $res = $feedback->find($id)->update($input);   
        if ($res) {
            return redirect()->route('admin.feedback.index',$input['type'])->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.feedback.index',$input['type'])->with('error', 'Tạo mới thất bại');
        }
    }

   public function update_multiple(Request $request) {
        $data = $request->all();
        
        if($request->action == "save"){      
            $records = DB::table('feedback')->where('type',$request->type)->orderBy('ordering','desc')->get();
           foreach ($records as $key => $record) {
               if($record->ordering != $data['orderBy'][$key]){
                    DB::table('feedback')->where('id',$record->id)->update(['ordering'=>$data['orderBy'][$key]]);
               }
           }
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
        else{
            if($request->check == null){
            return redirect()->back()->with('error',"Vui lòng chọn ít nhất một feedback");
            }

            if($request->action == "delete"){
               foreach($data['check'] as $key => $chk){
                     DB::table('feedback')->where('id',$chk)->delete();
               }  
               return redirect()->back()->with('success',"Xoá thành công");
            }
            elseif($request->action == "active"){
               foreach($data['check'] as $key => $chk){
                     DB::table('feedback')->where('id',$chk)->update(['status'=>1]);
               }  
               return redirect()->back()->with('success',"Cập nhật thành công");
            }else{
                  foreach($data['check'] as $key => $chk){
                     DB::table('feedback')->where('id',$chk)->update(['status'=>0]);
               } 
               } 
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
       DB::table('feedback')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

   

}
