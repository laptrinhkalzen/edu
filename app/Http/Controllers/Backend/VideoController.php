<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\VideoRepository;
use Repositories\CategoryRepository;
use App\Helpers\StringHelper;
use DB;
use File;

class VideoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(VideoRepository $videoRepo, CategoryRepository $categoryRepo) {
        $this->videoRepo = $videoRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index(Request $request) {
        $cat_id = $request->cat_id;
        if($cat_id != null ){
           $video_id = DB::table('video_category')->where('category_id',$cat_id)->get()->pluck('video_id');
           $records = DB::table('video')->whereIn('id',$video_id)->get(); 
        }
        elseif($cat_id == null || $cat_id == "0"){
           $records = $this->videoRepo->all();
        }
        $categories = DB::table('category')->where('type',1)->get();
        return view('backend/video/index', compact('records','categories','cat_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $count_order = DB::table('news')->count();
        $count_order++;
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_VIDEO);
        $category_html = StringHelper::getSelectOptions($options);
        return view('backend/video/create', compact('category_html','count_order'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->videoRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $input['created_by'] = \Auth::user()->id;

        if($request->video){
             $input['video'] = $this->videoRepo->uploadImage($request->video);
        }
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }
        $video = $this->videoRepo->create($input);
        $video->categories()->attach($input['category_id']);
        return redirect()->route('admin.video.index')->with('success', 'T???o m???i th??nh c??ng');
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
        $record = $this->videoRepo->find($id);
        if($record){
            $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_VIDEO);
            $category_ids = $record->categories()->get()->pluck('id')->toArray();
            $category_html = StringHelper::getSelectOptions($options, $category_ids);
            return view('backend/video/edit', compact('record', 'category_html'));
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
        $validator = \Validator::make($input, $this->videoRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $input['created_by'] = \Auth::user()->id;
        if($request->video){
            $this->videoRepo->checkExistFile($request->video);
            $input['video'] = $this->videoRepo->uploadImage($request->video);
        }

        $res = $this->videoRepo->update($input, $id);
        if ($res == true) {
            $video = $this->videoRepo->find($id);
            $video->categories()->sync($input['category_id']);
            return redirect()->route('admin.video.index')->with('success', 'C???p nh???t th??nh c??ng');
        } else {
            return redirect()->route('admin.video.index')->with('error', 'C???p nh???t th???t b???i');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $video = $this->videoRepo->find($id);
        $video->categories()->detach();
        $this->videoRepo->delete($id);
        return redirect()->route('admin.video.index')->with('success', 'X??a th??nh c??ng');
    }

     public function update_multiple(Request $request) {
        $data = $request->all();
        
        if($request->action == "save"){    
            $cat_id = $request->cat_id;
            if($cat_id != null ){
               $video_id = DB::table('video_category')->where('category_id',$cat_id)->get()->pluck('video_id');
               $records = DB::table('video')->whereIn('id',$video_id)->get(); 
            }
            elseif($cat_id == null || $cat_id == "0"){
               $records = $this->videoRepo->all();
            }
           foreach ($records as $key => $record) {
               if($record->ordering != $data['orderBy'][$key]){
                    DB::table('video')->where('id',$record->id)->update(['ordering'=>$data['orderBy'][$key]]);
               }
           }
           return redirect()->back()->with('success',"C???p nh???t th??nh c??ng");
        }
        else{
            if($request->check == null){
            return redirect()->back()->with('error',"Vui l??ng ch???n ??t nh???t m???t video");
            }

            if($request->action == "delete"){
               foreach($data['check'] as $key => $chk){
                     DB::table('video')->where('id',$chk)->delete();
               }  
               return redirect()->back()->with('success',"Xo?? th??nh c??ng");
            }
            elseif($request->action == "active"){
               foreach($data['check'] as $key => $chk){
                     DB::table('video')->where('id',$chk)->update(['status'=>1]);
               }  
               return redirect()->back()->with('success',"C???p nh???t th??nh c??ng");
            }else{
                  foreach($data['check'] as $key => $chk){
                     DB::table('video')->where('id',$chk)->update(['status'=>0]);
               } 
               } 
           return redirect()->back()->with('success',"C???p nh???t th??nh c??ng");
        }
    }

}
