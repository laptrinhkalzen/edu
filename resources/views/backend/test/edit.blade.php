@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.test.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
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
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Thông tin cơ bản</a></li>
                 <!--    <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-stack2 mr-2"></i> Danh sách câu hỏi</a></li> -->
<!--                     <li class="nav-item"><a href="#left-icon-tab3" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Thẻ meta</a></li> -->

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="left-icon-tab1">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title" value="{!!is_null(old('title'))?$record->title:old('title')!!}" required="">
                                            {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Url <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" readonly="" name="alias" value="{!!is_null(old('alias'))?$record->alias:old('alias')!!}" required>
                                            {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Danh mục <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="select-search form-control" name="category_id" data-placeholder="Chọn danh mục" multiple="" required>
                                                {!!$category_html!!}
                                            </select>
                                            {!! $errors->first('category_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <!--   <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Loại test <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="select-search form-control" name="type" data-placeholder="Chọn loại test"  required>
                                               @if($record->type == 1)
                                                   <option selected="" class="form-control" value="1">Listen</option>
                                                   <option class="form-control" value="2">Reading</option>
                                               @else
                                                   <option class="form-control" value="1">Listen</option>
                                                   <option selected="" class="form-control" value="2">Reading</option>
                                               @endif
                                            </select>
                                            {!! $errors->first('type', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div> -->
                                   <!--  <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Mô tả </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description">{!!old('description')!!}</textarea>
                                        </div>
                                    </div> -->
                                      <div class="form-group row" data-field="images">
                                        <label class="col-md-2 col-form-label text-right">Hình ảnh <span class="text-danger">*</span></label>
                                        <div class="col-md-10 div-image">
                                            <input type="hidden" class="image_data" name="images" value="{!!old('images')!!}" required=""/>
                                            <input type="file" id="images" multiple="" onclick="openKCFinder(this)" data-value="{!!old('images')!!}" class="file-input-overwrite" data-field="images">
                                            {!! $errors->first('images', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                              <!--   <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Giá </label>
                                    <div class="col-md-7">
                                        <input type="text" name="price" class="form-control touchspin text-center" value="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Giá khuyến mãi </label>
                                    <div class="col-md-7">
                                        <input type="text" name="sale_price" class="form-control touchspin text-center" value="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="form-check-label col-md-4  text-left">Hẹn ngày đăng </label>
                                    <div class="input-group col-md-7">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                        </span>
                                        <input type="text" class="form-control pickadate" placeholder="Ngày đăng" name="post_schedule">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Từ khóa <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control tokenfield" name="keywords" data-fouc required="">
                                        {!! $errors->first('keywords', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Thứ tự </label>
                                    <div class="col-md-5">
                                        <input type="text" name="ordering" class="form-control touchspin text-center" value="0">
                                    </div>
                                </div> -->
                                  <div class="form-group row">   
                                <label class="col-form-label col-md-3 text-right">Sắp xếp </label>
                                <div class="col-md-5">
                                    <input type="text" name="ordering" class="form-control touchspin text-center" value="{{$record->ordering}}">
                                </div>
                            </div>

                 
              
                                <div class="form-group row">
                                    <div class="form-check col-md-4 form-check-right">
                                        <label class="form-check-label float-right">
                                            Hiển thị
                                            @if($record->status == 1)
                                            <input checked="" type="checkbox" class="form-check-input-styled" name="status" data-fouc="">
                                            @else
                                               <input type="checkbox" class="form-check-input-styled" name="status" data-fouc="">
                                            @endif
                                        </label>
                                    </div>
                                </div>
                             
                               <!--  <div class="form-group row">
                                    <div class="form-check col-md-4 form-check-right">
                                        <label class="form-check-label float-right">
                                            Sản phẩm nổi bật
                                            <input type="checkbox" class="form-check-input-styled" name="is_hot" data-fouc="">
                                        </label>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Nội dung: </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control ckeditor" id="content" name="note">{{$record->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a type="button" href="{{route('admin.test.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
                </div>
                </form>
                   
                    <div class="tab-pane fade" id="left-icon-tab2">
                        <table class="table datatable-basic">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                                <th>#</th>
                                <th>Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Tác vụ</th>
                            </tr>
                        </tbody>
                    </table>
                    </div>

                </div>
                
            </div>
        </div>
  
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

<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>

@stop
