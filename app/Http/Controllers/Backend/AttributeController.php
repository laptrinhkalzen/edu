<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\AttributeRepository;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(AttributeRepository $attributeRepo) {
        $this->attributeRepo = $attributeRepo;
    }
    public function index()
    {
        $records = $this->attributeRepo->all();
        foreach ($records as $key => $val) {
            $records[$key]['parent'] = $this->attributeRepo->readParentCategory($val->parent_id);
        }
        return view('backend/attribute/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_html = \App\Helpers\StringHelper::getSelectOptions($this->attributeRepo->all()->where('parent_id', 0));
        return view('backend/attribute/create', compact('parent_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = \Validator::make($input, $this->attributeRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($input['parent_id'] == null) {
            $input['parent_id'] = 0;
        }
        $attribute = $this->attributeRepo->create($input);
        if ($attribute->id){
            return redirect()->route('admin.attribute.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.attribute.index')->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id)
    {
        $record = $this->attributeRepo->find($id);
        $parent_html = \App\Helpers\StringHelper::getSelectOptions($this->attributeRepo->all()->where('parent_id', 0), $record->parent_id);
        return view('backend/attribute/edit', compact('record', 'parent_html'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        $validator = \Validator::make($input, $this->attributeRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($input['parent_id'] == null) {
            $input['parent_id'] = 0;
        }
        $res = $this->attributeRepo->update($input, $id);
        if ($res){
            return redirect()->route('admin.attribute.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.attribute.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->attributeRepo->delete($id);
        if ($res) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
        
    }
}
