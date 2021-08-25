<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;

class ContactController extends Controller
{
    public function __construct(ContactRepository $contactRepo) {
        $this->contactRepo = $contactRepo;
    }

    public function index($type)
    {

        $records = Contact::where('type',$type)->orderBy('created_at','desc')->get();
        return view('backend/contact/index', compact('records','type'));
    }

    public function show($id)
    {
        $record = $this->contactRepo->find($id);
        return view('backend/contact/detail', compact('record'));
    }

    public function destroy($id)
    {
        $this->contactRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
