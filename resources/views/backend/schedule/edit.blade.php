@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.schedule.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
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

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="left-icon-tab1">
                        <div class="row">
                            <div class="col-md-10" style="">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <fieldset>
                                    

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title" value="{!!$record->title!!}" required="">
                                            {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tên hiệu <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" readonly="" name="alias" value="{!!$record->alias!!}" required>
                                            {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Cở sở/ Trung tâm<span class=""></span></label>
                                        <div class="col-md-10">
                                          <select class="select-search form-control" id="" name="contact_address_id" data-placeholder="Cở sở/ Trung tâm"  required>
                                             @foreach($address as $add)
                                                 @if($add->id == $record->contact_address_id)
                                                 <option selected="" value="{{$add->id}}">{{$add->name}}</option>
                                                 @else
                                                 <option value="{{$add->id}}">{{$add->name}}</option>
                                                 @endif
                                             @endforeach
                                        </select>
                                            {!! $errors->first('contact_address_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thể loại<span class=""></span></label>
                                        <div class="col-md-10">
                                           <select class="select-search form-control"  name="type" data-placeholder="Thể loại"  required>  
                                                @if($record->type == 1)               
                                                 <option selected="" value="1">Online</option>
                                                 <option value="2">Offline</option>
                                                 @else
                                                  <option value="1">Online</option>
                                                 <option selected="" value="2">Offline</option>
                                                 @endif
                                            </select>
                                            {!! $errors->first('type', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                      <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Khoá học<span class=""></span></label>
                                        <div class="col-md-10">
                                           <select class="select-search form-control" id="" name="course_id" data-placeholder="Cở sở/ Trung tâm"  required>
                                             @foreach($courses as $course)
                                                 @if($course->id == $record->course_id)
                                                 <option selected="" value="{{$course->id}}">{{$course->title}}</option>
                                                 @else
                                                 <option value="{{$course->id}}">{{$course->title}}</option>
                                                 @endif
                                             @endforeach
                                        </select>
                                            {!! $errors->first('course_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thứ tự<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="ordering" value="{!!$record->ordering!!}" required>
                                            {!! $errors->first('ordering', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thời gian học<span class=""></span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="schedule" value="{!!$record->schedule!!}" >
                                            {!! $errors->first('schedule', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thời gian học chi tiết<span class=""></span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="schedule_detail" value="{!!$record->schedule_detail!!}" >
                                            {!! $errors->first('schedule_detail', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Ngày khai giảng<span class=""></span></label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" name="opening" value="{!!$record->opening!!}" >
                                            {!! $errors->first('opening', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                                                      
                          
                                    <!--   <div class="col-md-12" id="">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thứ tự: </label>
                                        <div class="col-md-10">
                                       <input class="form-control" name="ordering" value="{!$record->ordering!!}"  type="number" id=""  />
                                        {!! $errors->first('ordering', '<span class="text-danger">:message</span>') !!}
                                   </div>
                                    </div>
                                    
                                    </div> -->

                                    <div class="form-group row">
                                    <div class="form-check col-md-4 form-check-right">
                                        <label class="form-check-label float-right">
                                            Kích hoạt
                                            @if($record->status == 1)
                                            <input checked="" type="checkbox" class="form-check-input-styled" name="status" data-fouc="">
                                            @else
                                               <input type="checkbox" class="form-check-input-styled" name="status" data-fouc="">
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <a type="button" href="{{route('admin.schedule.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                </fieldset>
                            </div>
                            
                           
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
<script type="text/javascript">
    $('#select_type').on('change',function(){
        var type = $(this).val();
        if(type==1){
            $('#reading_type').hide();
            $('#listening_type').show();
        }else{
            $('#reading_type').show();
            $('#listening_type').hide();
        }
    });
</script>
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
