<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = ['name','member_id','mobile','course','course_id','company_name','email','content','is_read','created_at'];
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function course_name($id) {
        return DB::table('course')->where('id',$id)->pluck('title')->first();
    }

    public function address_name($id) {
        return DB::table('contact_address')->where('id',$id)->pluck('name')->first();
    }

      public function schedule_name($id) {
        return DB::table('schedule')->where('id',$id)->pluck('title')->first();
    }

}
