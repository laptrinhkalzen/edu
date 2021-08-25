@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.teacher.store')!!}" method="POST" enctype="multipart/form-data">
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
                            <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Thông tin giảng viên</a></li>
                           <!--  <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Thông tin bằng cấp</a></li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-tab1">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                        <fieldset>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Họ tên <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="name" value="{!!old('name')!!}" required="">
                                                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Biệt danh<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"  name="nickname" value="{!!old('nickname')!!}" required>
                                                    {!! $errors->first('nickname', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                            <div class="col-md-3">
                                            </div>
                                            <div class="form-group col-md-2">
                                                 <img src="{{url('/img/avatar-drive.png')}}" id ="frame" alt="test" width="150" height="150" />
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="required">Avatar</label>
                                                <input name="avatar" type="file" class="form-control" value="{!!old('avatar')!!}" onchange='UpdatePreview()'>
                                                {!! $errors->first('avatar', '<span class="text-danger">:message</span>') !!}
                                            </div>
                                            </div> 
                                    
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-right">Tóm tắt</label>
                                            <div class="col-md-9">
                                               <textarea class="form-control" name="summary"></textarea>
                                            </div>
                                        </div>

             

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Nội dung: </label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control ckeditor" id="content" name="content">{!!old('content')!!}</textarea>
                                                </div>
                                            </div>
                          
                                       
                                        <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Thứ tự<span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control"  name="ordering" value="{!!$ordering++!!}" required>
                                                    {!! $errors->first('ordering', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>

                                
                                            <div class="form-group row">
                                                <div class="form-check col-md-5 form-check-right">
                                                    <label class="form-check-label float-right">
                                                        Kích hoạt
                                                        <input type="checkbox" class="form-check-input-styled" name="status" value="1" data-fouc="">
                                                    </label>
                                                </div>
                                            </div>      
                                        </fieldset>
                                        <div class="text-right">
                                            <a type="button" href="{{route('admin.teacher.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  <div class="tab-pane fade" id="left-icon-tab2">
                                <div class="row input_fields_wrap">
                                    <div class="col-md-10" >
                                        <button style="float: right; margin-bottom: 20px;" class="btn btn-primary add_field_button" >Thêm bằng cấp/Chứng chỉ</button>
                                    </div> 
                                      
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-right">Tên bằng cấp/Chứng chỉ</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="title[]" value="{!!old('title')!!}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="required">Ảnh bằng cấp/Chứng chỉ</label>
                                                <input name="image[]" type="file" class="form-control" onchange='UpdatePreview()'>
                                                {!! $errors->first('degree_image', '<span class="text-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                      

                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
@stop
@section('script')
@parent
<!-- <script type="text/javascript">
    $(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++;
            var html="";
            html+='<div style="margin-top: 30px;" class="col-md-10 col-md-offset-1">';
            html+='<div class="form-group row">';
            html+='<label class="col-md-3 col-form-label text-right">Tên bằng cấp/Chứng chỉ'+" thứ "+ x+'</label>';
            html+='<div class="col-md-9">';
            html+='<input type="text" class="form-control" name="title[]" value="{!!old('title')!!}">';
            html+='</div></div>';                       
            html+='<div class="form-group row">';
            html+='<div class="col-md-3">';
            html+='</div>';
            html+='<div class="form-group col-md-3">';
            html+='<label class="required">Ảnh bằng cấp/Chứng chỉ</label>';
            html+='<input name="image[]" type="file" class="form-control UpdatePreview">';
            html+='</div>';
            html+='</div>';
            html+='<button style="float:right;" class="btn btn-danger remove_field">Xoá</button>';    
            html+='</div>';     
            html+='</div>';                
            $(wrapper).append(html); //add input box
        }
        else{
            alert('Bạn chỉ được thêm tối đa 4 trường');
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script> -->
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
