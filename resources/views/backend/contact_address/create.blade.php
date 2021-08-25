@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.contact_address.store')!!}" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" name="name" value="{!!old('name')!!}" required="">
                                            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Địa chỉ<span class=""></span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="address" value="{!!old('address')!!}">
                                            {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tỉnh thành<span class=""></span></label>
                                        <div class="col-md-10">
                                           <select class="select-search form-control" id="select_type" name="city" data-placeholder="Chọn tỉnh thành"  required>
                                              <option value="1" selected="">Hà Nội</option>
                                              <option value="2">Hồ Chí Minh</option>
                                              <option value="3">Khác</option>
                                            </select>
                                            {!! $errors->first('city', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Số điện thoại 1<span class=""></span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="phone_1" value="{!!old('phone_1')!!}" >
                                            {!! $errors->first('phone_1', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Số điện thoại 2<span class=""></span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="phone_2" value="{!!old('phone_2')!!}" >
                                            {!! $errors->first('phone_2', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                                                      
                          
                                      <div class="col-md-12" id="">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thứ tự: </label>
                                        <div class="col-md-10">
                                       <input class="form-control" name="ordering" value="{{++$count_ordering}}"  type="number" id=""  />
                                        {!! $errors->first('ordering', '<span class="text-danger">:message</span>') !!}
                                   </div>
                                    </div>
                                    
                                    </div>

                                    <div class="form-group row">
                                    <div class="form-check col-md-4 form-check-right">
                                        <label class="form-check-label float-right">
                                            Kích hoạt
                                            <input type="checkbox" class="form-check-input-styled" name="status" data-fouc="">
                                        </label>
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
