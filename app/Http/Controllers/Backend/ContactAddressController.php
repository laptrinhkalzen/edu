<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactAddress;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Repositories\ContactAddressRepository;

class ContactAddressController extends Controller
{

    public function __construct(ContactAddressRepository $contactaddressRepo)
    {
        $this->contactaddressRepo = $contactaddressRepo;
    }

    public function index(Request $request)
    {
        $records = DB::table('contact_address')->orderBy('ordering', 'desc')->get();
        return view('backend/contact_address/index', compact('records'));
    }


    public function create()
    {
        $count_ordering = DB::table('contact_address')->count();
        return view('backend/contact_address/create', compact('count_ordering'));
    }

    public function store(Request $request)
    {

        $input = $request->all();

        $validator = \Validator::make($input, $this->contactaddressRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $res = $this->contactaddressRepo->create($input);
        if ($res) {
            return redirect()->route('admin.contact_address.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.contact_address.index')->with('error', 'Tạo mới thất bại');
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
        $record = $this->contactaddressRepo->find($id);
        if ($record) {

            return view('backend/contact_address/edit', compact('record'));
        } else {
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
    public function update(Request $request, $id)
    {

        $input = $request->all();

        $validator = \Validator::make($input, $this->contactaddressRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $res = $this->contactaddressRepo->find($id)->update($input);
        if ($res) {
            return redirect()->route('admin.contact_address.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.contact_address.index')->with('error', 'Cập nhật thất bại');
        }
    }

    public function update_multiple(Request $request)
    {
        $data = $request->all();

        if ($request->action == "save") {
            $records = DB::table('contact_address')->orderBy('ordering', 'desc')->get();
            foreach ($records as $key => $record) {
                if ($record->ordering != $data['orderBy'][$key]) {
                    DB::table('contact_address')->where('id', $record->id)->update(['ordering' => $data['orderBy'][$key]]);
                }
            }
            return redirect()->back()->with('success', "Cập nhật thành công");
        } else {
            if ($request->check == null) {
                return redirect()->back()->with('error', "Vui lòng chọn ít nhất một địa chỉ liên hệ");
            }

            if ($request->action == "delete") {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('contact_address')->where('id', $chk)->delete();
                }
                return redirect()->back()->with('success', "Xoá thành công");
            } elseif ($request->action == "active") {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('contact_address')->where('id', $chk)->update(['status' => 1]);
                }
                return redirect()->back()->with('success', "Cập nhật thành công");
            } else {
                foreach ($data['check'] as $key => $chk) {
                    DB::table('contact_address')->where('id', $chk)->update(['status' => 0]);
                }
            }
            return redirect()->back()->with('success', "Cập nhật thành công");
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
        $this->contactaddressRepo->find($id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
