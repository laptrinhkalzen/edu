<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\GalleryRepository;
use Repositories\CategoryRepository;
use Repositories\AttributeRepository;
use Repositories\PostHistoryRepository;
use DB;

class GalleryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(GalleryRepository $galleryRepo, CategoryRepository $categoryRepo, AttributeRepository $attributeRepo, PostHistoryRepository $postHistoryRepo) {
        $this->galleryRepo = $galleryRepo;
        $this->categoryRepo = $categoryRepo;
        $this->attributeRepo = $attributeRepo;
        $this->postHistoryRepo = $postHistoryRepo;
    }

    public function index(Request $request) {
       

         $cat_id = $request->cat_id;
        if($cat_id != null ){
           $gallery_id = DB::table('gallery_category')->where('category_id',$cat_id)->get()->pluck('gallery_id');
           $records = DB::table('gallery')->whereIn('id',$gallery_id)->get(); 
        }
        elseif($cat_id == null || $cat_id == "0"){
            $records = $this->galleryRepo->all();
        }
        $categories = DB::table('category')->where('type',3)->get();
        return view('backend/gallery/index', compact('records','categories','cat_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $count_order = DB::table('news')->count();
        $count_order++;
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_GALLERY);
        $category_html = \App\Helpers\StringHelper::getSelectOptions($options);
        // $attributes = $this->attributeRepo->readAttributeByParentAdmin($module = "gallery");
        return view('backend/gallery/create', compact('category_html','count_order'));
    }

    //Lấy danh sách thuộc tính hình ảnh gửi lên và gom lại cho đúng form
    public function getGalleryAttribute($input) {
        $attributes = array();
        foreach ($input['attribute'] as $key => $val) {
            if ($val != null) {
                $attributes[$key] = ['value' => $val];
            }
        }
        if (isset($input['attribute_select'])) {
            foreach ($input['attribute_select'] as $key => $val) {
                if ($val != null) {
                    $attributes[$val] = ['value' => null];
                }
            }
        }
        return $attributes;
    }

    //Thêm vào lịch sử bài đăng nếu hình ảnh thuộc dự án
    public function addPostHistory($gallery) {
        $exist_item = $this->postHistoryRepo->findByItemId($gallery->id, $module = 'gallery');
        $post_history['item_id'] = $gallery->id;
        if (!$exist_item) {
            $post_history['created_at'] = $gallery->created_at;
            $post_history['updated_at'] = $gallery->post_schedule ?: $gallery->updated_at;
            $post_history['module'] = 'gallery';
            $this->postHistoryRepo->create($post_history);
        } else {
            $this->postHistoryRepo->update($post_history, $exist_item->id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Validation
        $input = $request->all();
        $validator = \Validator::make($input, $this->galleryRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //Adjust some field
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['created_by'] = \Auth::user()->id;
        $input['view_count'] = 0;
        $gallery = $this->galleryRepo->create($input);
        //Thêm vào lịch sử đăng bài
        $this->addPostHistory($gallery);
        //Thêm danh mục hình ảnh
        $gallery->categories()->attach($input['category_id']);
        //Thêm thuộc tính hình ảnh
        if ($gallery) {
            return redirect()->route('admin.gallery.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.gallery.index')->with('error', 'Tạo mới thất bại');
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
    public function edit($id) {
        $record = $this->galleryRepo->find($id);
        if($record){
            $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_GALLERY);
            $category_ids = $record->categories()->get()->pluck('id')->toArray();
            $category_html = \App\Helpers\StringHelper::getSelectOptions($options, $category_ids);
            return view('backend/gallery/edit', compact('record', 'category_html'));
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
        //Validation
        $input = $request->all();
        $validator = \Validator::make($input, $this->galleryRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //Adjust some field
        $input['created_by'] = \Auth::user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }
        $res = $this->galleryRepo->update($input, $id);
        $gallery = $this->galleryRepo->find($id);
        if ($gallery->project_id > 0) {
            //Thêm vào lịch sử đăng bài nếu hình ảnh đó thuộc dự án
            $this->addPostHistory($gallery);
        }
        //Thêm danh mục hình ảnh
        $gallery->categories()->sync($input['category_id']);
     
        if ($res) {
            return redirect()->route('admin.gallery.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.gallery.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $gallery = $this->galleryRepo->find($id);
        $gallery->categories()->detach();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

  public function update_multiple(Request $request) {
        $data = $request->all();
        
        if($request->action == "save"){    
        $cat_id = $request->cat_id;  
           if($cat_id != null ){
               $gallery_id = DB::table('gallery_category')->where('category_id',$cat_id)->get()->pluck('gallery_id');
               $records = DB::table('gallery')->whereIn('id',$gallery_id)->get(); 
            }
            elseif($cat_id == null || $cat_id == "0"){
                $records = $this->galleryRepo->all();
            }
           foreach ($records as $key => $record) {
               if($record->ordering != $data['orderBy'][$key]){
                    DB::table('gallery')->where('id',$record->id)->update(['ordering'=>$data['orderBy'][$key]]);
               }
           }
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
        else{
            if($request->check == null){
            return redirect()->back()->with('error',"Vui lòng chọn ít nhất một ảnh");
            }

            if($request->action == "delete"){
               foreach($data['check'] as $key => $chk){
                     DB::table('gallery')->where('id',$chk)->delete();
               }  
               return redirect()->back()->with('success',"Xoá thành công");
            }
            elseif($request->action == "active"){
               foreach($data['check'] as $key => $chk){
                     DB::table('gallery')->where('id',$chk)->update(['status'=>1]);
               }  
               return redirect()->back()->with('success',"Cập nhật thành công");
            }else{
                  foreach($data['check'] as $key => $chk){
                     DB::table('gallery')->where('id',$chk)->update(['status'=>0]);
               } 
               } 
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
    }
}
