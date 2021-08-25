
@extends('backend.layouts.master')
@section('content')
<div class="content">  
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Cập nhật</h5>
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
                    <form action="{!!route('admin.attribute.update', ['id' => $record->id])!!}" class="form-validate-jquery" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
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
                                    <input type="text" class="form-control" name="title" value="{!!is_null(old('title'))?$record->title:old('title')!!}" required="">
                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Kiểu thuộc tính <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select-search"  data-fouc name="type" required="">
                                        <option value="text" @if ($record->type == 'text') selected @endif>Text</option>
                                        <option value="select" @if ($record->type == 'select') selected @endif>Lựa chọn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-right">Loại thuộc tính <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select-search"  data-fouc name="module" required="">
                                        <option value="product" @if ($record->module == 'product') selected @endif>Sản phẩm</option>
                                        <option value="gallery" @if ($record->module == 'gallery') selected @endif>Hình ảnh</option>
                                    </select>
                                </div>
                            </div>

                        </fieldset>
                        <div class="text-right">
                            <a type="button" href="{{route('admin.attribute.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
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