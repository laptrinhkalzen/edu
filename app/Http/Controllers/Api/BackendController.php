<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use App\Repositories\OrderRepository;

class BackendController extends Controller {

    public function __construct(OrderRepository $orderRepo) {
        $this->orderRepo = $orderRepo;
    }

    public function slugify(Request $request) {
        return response()->json(['alias' => StringHelper::slug($request->get('title'))]);
    }

    public function changeStatus(Request $request) {
        $order_id = $request->get('order_id');
        $status = $request->get('status');
        $this->orderRepo->update(['status' => $status], $order_id);
        return response()->json(array('success' => true));
    }

}
