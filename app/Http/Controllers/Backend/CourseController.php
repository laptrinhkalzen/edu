<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Teacher;
use Repositories\CourseRepository;
use App\Helpers\StringHelper;
class CourseController extends Controller
{

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }

    public function index($type)
    {
        $records = $this->courseRepo->readCourseByType($type);
        return view('backend/course/index', compact('records', 'type'));
    }

    public function create($type)
    {
        $teachers = DB::table('teacher')->get();
        $studies = DB::table('study')->get();
        $count_ordering = $this->courseRepo->readCourseByType($type)->count();
        return view('backend/course/create', compact('count_ordering', 'teachers', 'studies', 'type'));
    }

    public function store(Request $request,$type)
    {
        $input = $request->all();
        $validator = \Validator::make($input, $this->courseRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['teacher_id'] = implode(',', $input['teacher_id']);
        $get_image = $request->image;
        $this->courseRepo->uploadImage($get_image);
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['type']=$type;
        $res = $this->courseRepo->create($input);
       
        //Thêm danh mục sản phẩm
        if ($res) {
            return redirect()->route('admin.course.index', $type)->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.course.index', $type)->with('error', 'Tạo mới thất bại');
        }
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $id)
    {
        $teachers = DB::table('teacher')->get();
        $studies = DB::table('study')->get();
        $record = $this->courseRepo->find($id);
            //Lấy danh sách id thuộc tính của sản phẩm
        return view('backend/course/edit', compact('record', 'teachers', 'studies', 'type', 'id'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type, $id )
    {
        $input = $request->all();
        
        $validator = \Validator::make($input, $this->courseRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input['teacher_id'] = implode(',', $input['teacher_id']);
        $get_image = $request->image;
        if(empty($get_image)){
            unset($input['avatar']);
        }else{
            $this->courseRepo->uploadImage($get_image);
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['type']=$type;
        $res = $this->courseRepo->find($id)->update($input);

        //Thêm danh mục sản phẩm
        if ($res) {
            return redirect()->route('admin.course.index', $type)->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.course.index', $type)->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $id)
    {
        $this->courseRepo->destroy($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function update_multiple(Request $request)
    {
        $data = $request->all();

        if ($request->action == "save") {
            $records =  DB::table('course')->where('is_pro', null)->where('is_online', null)->orderBy('ordering', 'desc')->get();
            foreach ($records as $key => $record) {
                if ($record->ordering != $data['orderBy'][$key]) {
                    DB::table('course')->where('id', $record->id)->update(['ordering' => $data['orderBy'][$key]]);
                }
            }
            return redirect()->back()->with('success', "Cập nhật thành công");
        } else {
            if ($request->check == null) {
                return redirect()->back()->with('error', "Vui lòng chọn ít nhất một khoá học");
            }

            if ($request->action == "delete") {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('course')->where('id', $chk)->delete();
                }
                return redirect()->back()->with('success', "Xoá thành công");
            } elseif ($request->action == "active") {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('course')->where('id', $chk)->update(['status' => 1]);
                }
                return redirect()->back()->with('success', "Cập nhật thành công");
            } else {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('course')->where('id', $chk)->update(['status' => 0]);
                }
            }
            return redirect()->back()->with('success', "Cập nhật thành công");
        }
    }

    public function getProductAttributes($input)
    {
        $attributes = array();
        foreach ($input['attribute'] as $key => $val) {
            $attributes[$key] = ['value' => $val];
        }
        foreach ($input['attribute_select'] as $key => $val) {
            if ($val != null) {
                $attributes[$val] = ['value' => null];
            }
        }
        return $attributes;
    }



    public function addPostHistory($test)
    {

        $post_history['item_id'] = $test->id;
        $post_history['created_at'] = $test->created_at;
        $post_history['updated_at'] = $test->post_schedule ?: $test->updated_at;
        $post_history['module'] = 'test';
        $this->postHistoryRepo->create($post_history);
    }
}
