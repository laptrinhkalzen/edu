@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.video.update', ['id' => $record->id])!!}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-9">
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
                            <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Thẻ meta</a></li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-tab1">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                        <fieldset>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="title" value="{!!is_null(old('title'))?$record->title:old('title')!!}" required="">
                                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Url <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" readonly="" name="alias" value="{!!is_null(old('alias'))?$record->alias:old('alias')!!}" required>
                                                    {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Danh mục <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="select-search form-control" name="category_id[]"data-placeholder="Chọn danh mục" multiple="" required>
                                                        {!!$category_html!!}
                                                    </select>
                                                    {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Link video <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="video_url" value="{!!is_null(old('video_url'))?$record->video_url:old('video_url')!!}" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Mô tả: </label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="description">{!!is_null(old('description'))?$record->description:old('description')!!}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row" data-field="images">
                                                <label class="col-md-3 col-form-label text-right">Hình ảnh</label>
                                                <div class="col-md-9 div-image">
                                                    <input type="hidden" class="image_data" name="images" value="{!!is_null(old('images'))?$record->images:old('images')!!}"/>
                                                    <input type="file" id="images" onclick="openKCFinder(this)" data-value="{!!is_null(old('images'))?$record->images:old('images')!!}" class="file-input-overwrite" data-field="images">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Nội dung: </label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control ckeditor" id="content" name="content">{!!is_null(old('content'))?$record->content:old('content')!!}</textarea>
                                                </div>
                                            </div>


                                        </fieldset>
                                        <div class="text-right">
                                            <a type="button" href="{{route('admin.video.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
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
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4 text-right">Thứ tự </label>
                            <div class="col-md-5">
                                <input type="number" min="1" name="ordering" class="form-control  text-center" value="{!!is_null(old('ordering'))?$record->ordering:old('ordering')!!}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-check col-md-5 form-check-right">
                                <label class="form-check-label float-right">
                                    Hiển thị
                                    <input type="checkbox" class="form-check-input-styled" name="status" data-fouc="" @if($record->status) checked @endif>
                                </label>
                            </div>
                        </div>
                       <!--  <div class="form-group row">
                            <div class="form-check col-md-5 form-check-right">
                                <label class="form-check-label float-right">
                                    Video nổi bật
                                    <input type="checkbox" class="form-check-input-styled" name="is_hot" data-fouc="" @if($record->is_hot) checked @endif>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-check col-md-5 form-check-right">
                                <label class="form-check-label float-right">
                                    Video học simon
                                    <input type="checkbox" class="form-check-input-styled" name="is_simon" data-fouc="" @if($record->is_simon) checked @endif>
                                </label>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="form-check-label col-md-6  text-left">Hẹn ngày đăng </label>
                            <div class="input-group col-md-12" style="margin-top:20px">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                </span>
                                <input type="text" class="form-control pickadate" placeholder="Ngày đăng" name="post_schedule"value="{!!is_null(old('post_schedule'))?$record->getPostSchedule():old('post_schedule')!!}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Từ khóa</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control tokenfield" name="keywords" data-fouc value="{!!$record->keywords!!}">
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
