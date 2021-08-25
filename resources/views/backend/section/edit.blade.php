@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.section.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Cập nhật</h6>
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
                                   <!--  <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Chọn bài test <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="select-search form-control" name="test_id" data-placeholder="Chọn bài test"  required>
                                               @foreach($options as $option)
                                               <option value="{{$option->id}}">{{$option->title}}</option>
                                               @endforeach
                                            </select>
                                            {!! $errors->first('test_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" value="{!!$record->name!!}" required="">
                                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                   <!--   <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thể loại<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                             <select readonly class="select-search form-control" id="select_type" name="section_type" data-placeholder="Chọn bài test"  require="">
                                              <option selected="" disabled="">---Lựa chọn---</option>
                                              <option value="1">Listening</option>
                                              <option value="2">Reading</option>
                                              <option value="3">Pronunciation</option>
                                              <option value="4">Grammar</option>
                                              <option value="5">Vocabulary</option>
                                          </select>
                                        </div>
                                    </div> -->
                                                               
                                   
                                     @if($record->section_type==2)
                                    <div class="col-md-12" id="reading_type">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Nội dung bài đọc: </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control ckeditor" id="content" name="section_content">{{$record->content}}</textarea>
                                        </div>
                                    </div>
                                    
                                    </div>
                                       @elseif($record->section_type==1)
                                     <div class="col-md-12" id="listening_type">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Chọn file nghe: </label>
                                        <div class="col-md-10">
                                        <audio controls>
                                          <source src="{{asset($record->file)}}" >
                                        Your browser does not support the audio element.
                                        </audio>    
                                       <input class="form-control" name="file"  type="file" id=""  />
                                        {!! $errors->first('file', '<span class="text-danger">:message</span>') !!}
                                   </div>
                                    </div>
                                    
                                    </div>
                                    @endif
                                      <div class="col-md-12" >
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thứ tự: </label>
                                        <div class="col-md-10">
                                       <input class="form-control" name="ordering" value="{{$record->ordering}}"  type="number" />
                                        {!! $errors->first('ordering', '<span class="text-danger">:message</span>') !!}
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
