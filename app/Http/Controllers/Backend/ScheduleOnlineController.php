<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
use DB;
use Carbon\Carbon;

class ScheduleOnlineController extends Controller {



    public function index(Request $request) {
        $records = DB::table('schedule')->where('type',1)->orderBy('ordering','desc')->get();
        $courses = DB::table('course')->where('is_online',1)->get();
        $address = DB::table('contact_address')->orderBy('created_at','desc')->get();
        return view('backend/schedule_online/index', compact('records','courses', 'address'));
    }


    public function create() {
        $count_ordering =DB::table('schedule')->count();
        $courses = DB::table('course')->where('is_online',1)->get();
        $address = DB::table('contact_address')->get();
        return view('backend/schedule_online/create', compact('count_ordering','courses', 'address'));
    }

    public function store(Request $request) {
        $schedule = new Schedule();
        $input = $request->all();
        $input['contact_address_id'] = 0;
        $input['type'] = 1;
        $validator = \Validator::make($input, $schedule->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh'); 
        $res = $schedule->create($input);   
        if ($res) {
            return redirect()->route('admin.schedule_online.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.schedule_online.index')->with('error', 'Tạo mới thất bại');
        }
    }


    public function show($id) {
        //
    }


    public function edit($id) {
        $record = Schedule::find($id);
        if($record){
        $courses = DB::table('course')->where('is_online',1)->get();
        $address = DB::table('contact_address')->get();
        return view('backend/schedule_online/edit', compact('record','courses','address'));
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
        $schedule = new Schedule();
        $input = $request->all();
        $input['contact_address_id'] = 0;
        $input['type'] = 1;
        $validator = \Validator::make($input, $schedule->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh'); 
        $res = $schedule->find($id)->update($input);   
        if ($res) {
            return redirect()->route('admin.schedule_online.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.schedule_online.index')->with('error', 'Cập nhật thất bại');
        }
    }

     

     public function update_multiple(Request $request) {
        $data = $request->all();
        
        if($request->action == "save"){      
            $records = DB::table('schedule')->where('type',1)->orderBy('ordering','desc')->get();
           foreach ($records as $key => $record) {
               if($record->course_id != $data['course_id'][$key] || $record->contact_address_id != $data['contact_address_id'][$key]){
                    DB::table('schedule')->where('id',$record->id)->update(['course_id'=>$data['course_id'][$key], 'contact_address_id'=>$data['contact_address_id'][$key]]);
               }
           }
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
        else{
            if($request->check == null){
            return redirect()->back()->with('error',"Vui lòng chọn ít nhất một lịch học");
            }

            if($request->action == "delete"){
               foreach($data['check'] as $key => $chk){
                     DB::table('schedule')->where('id',$chk)->delete();
               }  
               return redirect()->back()->with('success',"Xoá thành công");
            }
            elseif($request->action == "active"){
               foreach($data['check'] as $key => $chk){
                     DB::table('schedule')->where('id',$chk)->update(['status'=>1]);
               }  
               return redirect()->back()->with('success',"Cập nhật thành công");
            }else{
                  foreach($data['check'] as $key => $chk){
                     DB::table('schedule')->where('id',$chk)->update(['status'=>0]);
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
       DB::table('schedule')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

   

}
