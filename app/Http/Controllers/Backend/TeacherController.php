<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\TeacherRepository;
use Repositories\Support\AbstractRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class TeacherController extends Controller
{

    public function __construct(TeacherRepository $teacherRepo)
    {
        $this->teacherRepo = $teacherRepo;
    }

    public function index()
    {
        $records = $this->teacherRepo->all();
        return view('backend/teacher/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordering = DB::table('teacher')->count();
        return view('backend/teacher/create', compact('ordering'));
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $validator = \Validator::make($input, $this->teacherRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $get_avatar = $request->avatar;
        $input['avatar'] = $this->teacherRepo->uploadImage($get_avatar);
        $create_teacher = $this->teacherRepo->create($input);
        if ($create_teacher) {
            return redirect()->route('admin.teacher.index')->with('success', 'Thêm mới thành công');
        } else {
            return redirect()->route('admin.teacher.index')->with('error', 'Thêm mới thất bại');
        }
    }


    public function edit($id)
    {

        $record = $this->teacherRepo->find($id);
        if ($record) {
            return view('backend/teacher/edit', compact('record'));
        } else {
            abort(404);
        }
    }


    public function update(Request $request, $id)
    {

        
        $input = $request->all();
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $validator = \Validator::make($input, $this->teacherRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $get_avatar = $request->avatar;
        if($get_avatar){
            $input['avatar'] = $this->teacherRepo->uploadImage($get_avatar);
        }else{
            unset( $input['avatar']);
        }
        

        $create_teacher = $this->teacherRepo->update($input, $id);
        if ($create_teacher) {
            return redirect()->route('admin.teacher.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.teacher.index')->with('error', 'Cập nhật thất bại');
        }
    }


    public function destroy($id)
    {
        $this->teacherRepo->destroy($id);
        return redirect()->route('admin.teacher.index')->with('success', 'Xóa thành công');
        //
    }

    public function update_multiple(Request $request)
    {
        $data = $request->all();

        if ($request->action == "save") {
            $records = $this->teacherRepo->orderBy('ordering', 'desc')->get();
            foreach ($records as $key => $record) {
                if ($record->ordering != $data['orderBy'][$key]) {
                    DB::table('teacher')->where('id', $record->id)->update(['ordering' => $data['orderBy'][$key]]);
                }
            }
            return redirect()->back()->with('success', "Cập nhật thành công");
        } else {
            if ($request->check == null) {
                return redirect()->back()->with('error', "Vui lòng chọn ít nhất một giảng viên");
            }

            if ($request->action == "delete") {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('teacher')->where('id', $chk)->delete();
                }
                return redirect()->back()->with('success', "Xoá thành công");
            } elseif ($request->action == "active") {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('teacher')->where('id', $chk)->update(['status' => 1]);
                }
                return redirect()->back()->with('success', "Cập nhật thành công");
            } else {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('teacher')->where('id', $chk)->update(['status' => 0]);
                }
            }
            return redirect()->back()->with('success', "Cập nhật thành công");
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
