@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.quizz.store')!!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="{{$type}}" name="type_quizz">
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
                                    <!-- <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Bài test <span class="text-danger">*</span></label>
                                        <div class="col-md-10">

                                            <select class="select-search form-control select_test" name="test_id" data-placeholder="Chọn danh mục" id=""  required>
                                                <option selected="" disabled="">Chọn bài test</option>
                                                @foreach($tests as $test)
                                                <option value="{{$test->id}}">{{$test->title}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('test_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Chọn bài tập <span class="text-danger">*</span></label>
                                        <div class="col-md-10" >

                                            <select class="select-search form-control " name="section_id" data-placeholder="Chọn bài tập" id=""  required>
                                            
                                                @foreach($sections  as $section)
                                                <option value="{{$section->id}}">{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('section_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title" value="{!!old('title')!!}" required="">
                                            {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                                               
                                   

                                    <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Nội dung: </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control ckeditor" id="content" name="content"></textarea>
                                        </div>
                                    </div>
                                    
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <a type="button" href="{{route('admin.quizz.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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
    $('.select_test').on('change',function(){
         $.ajax({
                url:'{{route("api.select_test")}}',
                method:"POST",
                dataType: "JSON",
                data:{test_id:$(this).val()},
                success:function(resp){
                    if(resp.success == 1){
                      var html="";
                      $.each(resp.sections, function (index, value) {
                             html+= '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                      $('.pick_test').html(html);
                    }else{
                        alert('Có lỗi trong quá trình xử lý');
                    }
                }
         });   
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
