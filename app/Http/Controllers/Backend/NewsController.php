<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\NewsRepository;
use Repositories\CategoryRepository;
use Repositories\PostHistoryRepository;
use DB;

class NewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(NewsRepository $newsRepo, CategoryRepository $categoryRepo, PostHistoryRepository $postHistoryRepo) {
        $this->newsRepo = $newsRepo;
        $this->categoryRepo = $categoryRepo;
        $this->postHistoryRepo = $postHistoryRepo;
    }

    public function index(Request $request) {
        // if (\Auth::user()->role_id == \App\User::ROLE_ADMINISTRATOR || \Auth::user()->role_id == \App\User::ROLE_EDITOR) {
        //     $records = $this->newsRepo->all();
        // } else {
        //     $records = $this->newsRepo->getAllByUserId(\Auth::user()->id);
        // }
        $cat_id = $request->cat_id;
        if($cat_id != null ){
           $news_id = DB::table('news_category')->where('category_id',$cat_id)->get()->pluck('news_id');
           $records = DB::table('news')->whereIn('id',$news_id)->get(); 
        }
        elseif($cat_id == null || $cat_id == "0"){
            $records = $this->newsRepo->all();
        }
        $categories = DB::table('category')->where('type',2)->get();
        return view('backend/news/index', compact('records','categories','cat_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $count_order = DB::table('news')->count();
        $count_order++;
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_NEWS);
        $category_html = \App\Helpers\StringHelper::getSelectOptions($options);
        return view('backend/news/create', compact('category_html','count_order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->newsRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status']) && \Auth::user()->role_id <> \App\User::ROLE_CONTRIBUTOR) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $input['is_hot'] = isset($input['is_hot']) ? 1 : 0;
        $input['is_ielts'] = isset($input['is_ielts']) ? 1 : 0;
        $input['created_by'] = \Auth::user()->id;
        $input['view_count'] = 0;
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }

        $news = $this->newsRepo->create($input);
        $news->categories()->attach($input['category_id']);
        if ($news) {
            return redirect()->route('admin.news.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.news.index')->with('error', 'Tạo mới thất bại');
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
        $record = $this->newsRepo->find($id);
        if($record){
            $record = $this->newsRepo->find($id);
            $category_ids = $record->categories()->get()->pluck('id')->toArray();
            $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_NEWS);
            $category_html = \App\Helpers\StringHelper::getSelectOptions($options, $category_ids);
            return view('backend/news/edit', compact('record', 'category_html'));
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
        $input = $request->all();
        $validator = \Validator::make($input, $this->newsRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        $input['status'] = (isset($input['status']) && \Auth::user()->role_id <> \App\User::ROLE_CONTRIBUTOR) ? 1 : 0;
        $input['is_hot'] = isset($input['is_hot']) ? 1 : 0;
        $input['is_ielts'] = isset($input['is_ielts']) ? 1 : 0;
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }

        $res = $this->newsRepo->update($input, $id);
        if ($res == true) {
            $news = $this->newsRepo->find($id);
            $news->categories()->sync($input['category_id']);
            return redirect()->route('admin.news.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.news.index')->with('error', 'Cập nhật thất bại');
        }
    }
    
       public function update_multiple(Request $request) {
        $data = $request->all();
        
        if($request->action == "save"){      
           $cat_id = $request->cat_id;
            if($cat_id != null ){
               $news_id = DB::table('news_category')->where('category_id',$cat_id)->get()->pluck('news_id');
               $records = DB::table('news')->whereIn('id',$news_id)->get(); 
            }
            elseif($cat_id == null || $cat_id == "0"){
                $records = $this->newsRepo->all();
            }
           foreach ($records as $key => $record) {
               if($record->ordering != $data['orderBy'][$key]){
                    DB::table('news')->where('id',$record->id)->update(['ordering'=>$data['orderBy'][$key]]);
               }
           }
           return redirect()->back()->with('success',"Cập nhật thành công");
        }
        else{
            if($request->check == null){
            return redirect()->back()->with('error',"Vui lòng chọn ít nhất một bài viết");
            }

            if($request->action == "delete"){
               foreach($data['check'] as $key => $chk){
                     DB::table('news')->where('id',$chk)->delete();
               }  
               return redirect()->back()->with('success',"Xoá thành công");
            }
            elseif($request->action == "active"){
               foreach($data['check'] as $key => $chk){
                     DB::table('news')->where('id',$chk)->update(['status'=>1]);
               }  
               return redirect()->back()->with('success',"Cập nhật thành công");
            }else{
                  foreach($data['check'] as $key => $chk){
                     DB::table('news')->where('id',$chk)->update(['status'=>0]);
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
        $news = $this->newsRepo->find($id);
        $news->categories()->detach();
        $this->newsRepo->delete($id);
        return redirect()->route('admin.news.index')->with('success', 'Xóa thành công');
        //
    }

    public function filter_news_cat($id){
        dd('1');
    }

}
