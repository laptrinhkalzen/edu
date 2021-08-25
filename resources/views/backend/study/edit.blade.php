@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.study.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
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
                                    <input type="hidden" name="is_best" value="1">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tên học viên<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" value="{!!$record->name!!}" required="">
                                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>     

                                     <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Điểm thi<span class="text-danger"></span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="point" value="{!!$record->point!!}" required>
                                            {!! $errors->first('point', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>  

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tóm tắt<span class="text-danger"></span></label>
                                        <div class="col-md-10">
                                            <textarea placeholder="Tóm tắt" class="form-control" name="summary">{!!$record->summary!!}</textarea>
                                            {!! $errors->first('summary', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>  

                                    <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-right">Mô tả</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control ckeditor" id="content" name="content">{!!$record->content!!}</textarea>
                                            </div>
                                    </div>                
                

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thứ tự<span class="text-danger"></span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="ordering"value="{!!$record->ordering!!}">
                                            {!! $errors->first('ordering', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    
                                     <div class="form-group row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="form-group col-md-2">
                                        @if($record->image == null)
                                         <img src="{{url('/img/avt.png')}}" id ="frame" alt="test" class="img-thumbnail" width="200" height="150" />
                                         @else
                                         <img src="{{asset($record->avatar)}}" id ="frame" alt="test" class="img-thumbnail" width="200" height="150" />
                                         @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="required">Ảnh đại diện</label>
                                        <input name="avatar" type="file" class="form-control" value="{!!old('avatar')!!}" onchange='UpdatePreview()'>
                                        {!! $errors->first('avatar', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    </div> 

                                    

                                   
                                    
                                    
                                    
                                  <div class="form-group row">
                                 
                                    <div class="form-check col-md-4 form-check-right">
                                        <label class="form-check-label float-right">
                                            Kích hoạt
                                            @if($record->status == 1)
                                            <input type="checkbox" checked="" class="form-check-input-styled" name="status" data-fouc="">
                                            @else
                                            <input type="checkbox" class="form-check-input-styled" name="status" data-fouc="">
                                            @endif
                                        </label>
                                    </div>
                                </div>

                                    <
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <a type="button" href="{{route('admin.study.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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
