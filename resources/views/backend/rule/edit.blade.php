@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.rule.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Tạo mới</h6>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>
                      <div class="card-body">
                        @if (Session::has('success'))
                        <div class="alert bg-success alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ Session::get('success') }}</span>
                        </div>
                        @elseif(Session::has('error'))
                        <div class="alert bg-danger alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ Session::get('error') }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Cài đặt tính điểm</a></li>
                           <!--  <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Thông tin bằng cấp</a></li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-tab1">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                        <fieldset>
                                     
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Điểm từ <span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="text"   class="form-control" name="from" value="{!!$record->from!!}" required="">
                                                    {!! $errors->first('from', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                                <span style="margin: 10px">đến</span>
                                                <div class="col-md-4">
                                                    <input type="text"  class="form-control" name="to" value="{!!$record->to!!}" required="">
                                                    {!! $errors->first('to', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                 <label class="col-md-3 col-form-label text-right">Chọn khoá học<span class="text-danger">*</span></label>
                                                 <div class="col-md-9 row">
                                                  @php
                                                      $list = explode(',',$record->courses);
                                                  @endphp

                                                @foreach($courses as $course)
                                                @if(in_array( $course->id , $list ))
                                                <div class="col-md-12"><input checked="" class="" value="{{$course->id}}" type="checkbox" style="margin-top :5px;" name="check[]" class="">{{$course->title}}</div>
                                                @else
                                                <div class="col-md-12"><input class="" value="{{$course->id}}" type="checkbox" style="margin-top :5px;" name="check[]" class="">{{$course->title}}</div>
                                                @endif
                                                @endforeach

                                                <b style="margin-top: 15px;" class="col-md-12">Lộ trình IELTS</b>
                                                <div class="col-md-9 row">
                                                @foreach($pro_courses as $pro_course)
                                                @if(in_array( $pro_course->id , $list ))
                                                <div c class="col-md-12">|__<input checked="" value="{{$pro_course->id}}" class="" type="checkbox" style="margin-top :5px;" name="check[]" class="">{{$pro_course->title}}</div>
                                                @else
                                                 <div class="col-md-12">|__<input value="{{$pro_course->id}}" class="" type="checkbox" style="margin-top :5px;" name="check[]" class="">{{$pro_course->title}}</div>
                                                @endif
                                                @endforeach

                                                <b style="margin-top: 15px;" class="col-md-12">Khoá học Ielts online</b>
                                                <div class="col-md-9 row">

                                                @foreach($online_courses as $online_course)
                                                 @if(in_array($online_course->id , $list ))
                                                <div  class="col-md-12">|__<input checked="" value="{{$online_course->id}}" class="" type="checkbox" style="margin-top :5px;" name="check[]" class="">{{$online_course->title}}</div>
                                                @else
                                                  <div class="col-md-12">|__<input value="{{$online_course->id}}" class="" type="checkbox" style="margin-top :5px;" name="check[]" class="">{{$online_course->title}}</div>
                                                @endif
                                                @endforeach
                                               </div>
                                            </div>

                                          
                          
                                
                                             
                                        </fieldset>
                                        <div class="text-right">
                                            <a type="button" href="{{route('admin.rule.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
@stop
@section('script')
@parent

<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/uniform.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
<!-- Theme JS files -->
<script src="{!! asset('assets/global_assets/js/plugins/forms/tags/tagsinput.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/tags/tokenfield.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/ui/prism.min.js') !!}"></script>
<!-- Theme JS files -->
<script src="{!! asset('assets/global_assets/js/plugins/ui/moment/moment.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/daterangepicker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/anytime.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.date.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.time.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/legacy.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/notifications/jgrowl.min.js') !!}"></script>
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script>

<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

@stop
