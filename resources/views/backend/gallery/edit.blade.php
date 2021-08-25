@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.gallery.update', ['id' => $record->id])!!}" method="POST" enctype="multipart/form-data">
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
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Thông tin cơ bản</a></li>
                    <!-- <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-stack2 mr-2"></i> Thuộc tính</a></li> -->
                    <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Thẻ meta</a></li>

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
                                            <select class="select-search form-control" name="category_id[]"data-placeholder="Chọn danh mục" multiple="" required>
                                                {!!$category_html!!}
                                            </select>
                                            {!! $errors->first('category_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Mô tả </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description">{!!is_null(old('description'))?$record->description:old('description')!!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row" data-field="images">
                                        <label class="col-md-2 col-form-label text-right">Hình ảnh <span class="text-danger">*</span></label>
                                        <div class="col-md-10 div-image">
                                            <input type="hidden" name="images" class="image_data" value="{!!is_null(old('images'))?$record->images:old('images')!!}" required=""/>
                                            <input type="file" id="images" onclick="openKCFinder(this)" data-value="{!!is_null(old('images'))?$record->images:old('images')!!}" class="file-input-overwrite" data-field="images">
                                            {!! $errors->first('images', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <div class="col-md-10 offset-2">
                                            <button type="button"  data-toggle="modal" data-target="#modal_default"class="btn btn-danger"><i class="icon-price-tag2 mr-2"></i> Gắn thẻ ảnh</button>
                                        </div>
                                    </div> -->
                                </fieldset>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="form-check-label col-md-4  text-left">Hẹn ngày đăng </label>
                                    <div class="input-group col-md-7">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                        </span>
                                        <input type="text" class="form-control pickadate" placeholder="Ngày đăng" name="post_schedule" value="{!!is_null(old('post_schedule'))?$record->getPostSchedule():old('post_schedule')!!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Từ khóa <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control tokenfield" name="keywords" data-fouc value="{!!is_null(old('keywords'))?$record->keywords:old('keywords')!!}" required="">
                                        {!! $errors->first('keywords', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Thứ tự </label>
                                    <div class="col-md-5">
                                        <input type="text" name="ordering" class="form-control touchspin text-center" value="{!!is_null(old('ordering'))?$record->ordering:old('ordering')!!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-check col-md-4 form-check-right">
                                        <label class="form-check-label float-right">
                                            Hiển thị
                                            <input type="checkbox" class="form-check-input-styled" name="status" data-fouc="" @if($record->status) checked @endif>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Nội dung: </label>
                                    <div class="col-md-12">
                                        <textarea class="form-control ckeditor" id="content" name="content">{!!is_null(old('content'))?$record->content:old('content')!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="left-icon-tab2">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Thẻ tiêu đề (SEO)</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meta_title" value="{!!is_null(old('meta_title'))?$record->meta_title:old('meta_title')!!}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Thẻ từ khóa (SEO) </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="meta_keywords">{!!is_null(old('meta_keywords'))?$record->meta_keywords:old('meta_keywords')!!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Thẻ mô tả (SEO) </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control maxlength-label-position" maxlength="255" name="meta_description">{!!is_null(old('meta_description'))?$record->meta_description:old('meta_description')!!}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a type="button" href="{{route('admin.gallery.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Basic modal -->
<div id="modal_default" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title count-tag">Gắn thẻ ảnh</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div id="tagged"></div>
                <img id="gallery-basic" class="taggd__image" data-key="{{$record->id}}" src="{{$record->images}}" onclick="clickcoord(event)" style="width: 100%"> 
            </div>

            <div class="modal-footer">
                <h6 class="tag-note"><span class="text-danger">*</span> <i><b>Lưu ý:</b> Click chuột trái 2 lần vào tag để chỉnh sửa</i></h6>
                <div id="droppable" class="ui-widget-header" style="opacity: 0">
                    <p><i class="icon-trash"></i> Xóa</p>
                </div>
                <button type="button" class="btn btn-link" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- /basic modal -->
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{!! asset('assets/backend/js/bootstrapmenu.min.js') !!}"></script>
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! asset('assets/backend/js/taggd.js') !!}"></script>
<script src="{!! asset('assets/backend/js/gallery.js') !!}"></script>
<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

@stop
