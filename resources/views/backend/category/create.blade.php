
@extends('backend.layouts.master')
@section('content')
<div class="content">  
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Tạo mới</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="{!!route('admin.category.store', ['type' => $type])!!}" class="form-validate-jquery" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <input type="hidden" name="type" value="{{$type}}"/>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Danh mục cha</label>
                                <div class="col-md-9">
                                    <select class="form-control select-search" data-placeholder="Chọn danh mục cha" data-fouc name="parent_id">
                                        {!!$parent_html!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" value="{!!old('title')!!}" required="">
                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Url <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="alias" readonly="" value="{!!old('alias')!!}" required="">
                                    {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row" data-field="image">
                                <label class="col-md-3 col-form-label text-right">Hình ảnh</label>
                                <div class="col-md-9 div-image">
                                    <input type="hidden" class="image_data" name="image" value="{!!old('image')!!}"/>
                                    <input type="file" id="image" onclick="openKCFinder(this)" data-value="{!!old('image')!!}" class="file-input-overwrite" data-field="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 text-right">Thứ tự </label>
                                <div class="col-md-2">
                                    <input type="text" name="ordering" class="form-control touchspin text-center" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-check col-md-3 form-check-right">
                                    <label class="form-check-label float-right">
                                        Hiển thị
                                        <input type="checkbox" class="form-check-input-styled" name="status" data-fouc>
                                    </label>
                                </div>
                                <div class="form-check col-md-3 form-check-right">
                                    <label class="form-check-label float-right">
                                        Hiển thị trang chủ
                                        <input type="checkbox" class="form-check-input-styled" data-fouc>
                                    </label>
                                </div>
                            </div>

                        </fieldset>
                        <div class="text-right">
                            <a type="button" href="{{route('admin.category.index', ['type' => $type])}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                        </div>


                    </form>
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

<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
@stop