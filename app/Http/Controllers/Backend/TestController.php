<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TestRepository;
use Repositories\CategoryRepository;

class TestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TestRepository $testRepo, CategoryRepository $categoryRepo) {
        $this->testRepo = $testRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index() {
        $records = $this->testRepo->all();
        return view('backend/test/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_TEST);
        $category_html = \App\Helpers\StringHelper::getSelectOptions($options);
        return view('backend/test/create', compact('category_html'));
    }

    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->testRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['is_hot'] = isset($input['is_hot']) ? 1 : 0;
        $input['created_by'] = \Auth::user()->id;
        $test = $this->testRepo->create($input);

        //Thêm danh mục sản phẩm
        $test->categories()->attach($input['category_id']);    
        if ($test) {
            return redirect()->route('admin.test.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.test.index')->with('error', 'Tạo mới thất bại');
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
        $record = $this->testRepo->find($id);
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_TEST);
        $category_ids = $record->categories()->get()->pluck('id')->toArray();
        $category_html = \App\Helpers\StringHelper::getSelectOptions($options, $category_ids);
        //Lấy danh sách id thuộc tính của sản phẩm
        return view('backend/test/edit', compact('record', 'category_html'));
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
        $validator = \Validator::make($input, $this->testRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        $input['status'] = isset($input['status']) ? 1 : 0;
        $res = $this->testRepo->update($input, $id);
        $test = $this->testRepo->find($id);
        //Thêm danh mục sản phẩm
        $test->categories()->sync($input['category_id']);
        //Thêm thuộc tính sản phẩm
        if ($res) {
            return redirect()->route('admin.test.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.test.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $test = $this->testRepo->find($id);
        $test->categories()->detach();
        $this->testRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getProductAttributes($input) {
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

    public function addPostHistory($test) {
        $post_history['item_id'] = $test->id;
        $post_history['created_at'] = $test->created_at;
        $post_history['updated_at'] = $test->post_schedule ?: $test->updated_at;
        $post_history['module'] = 'test';
        $this->postHistoryRepo->create($post_history);
    }

}
