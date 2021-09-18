@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <form action="{!! route('admin.course.update',['type'=>$type, 'id'=>$record->id]) !!}" method="POST" enctype="multipart/form-data">
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
                @if (Session::has('error'))
                    <div class="alert bg-danger alert-styled-left">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ Session::get('error') }}</span>
                    </div>
                @endif
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i
                                    class="icon-menu7 mr-2"></i> Thông tin cơ bản</a></li>
                        <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i
                                    class="icon-mention mr-2"></i> Thẻ meta</a></li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="left-icon-tab1">

                            <div class="row">
                                <div class="col-md-8">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                    <fieldset>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-right">Tiêu đề <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="title"
                                                    value="{!! $record->title !!}">
                                                {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-right">Tên hiệu <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="alias"
                                                    value="{!! $record->alias !!}">
                                                {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label text-right">Mô tả </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control ckeditor" id="content2"
                                                    name="summary">{!! $record->summary !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2  control-label text-right text-semibold"
                                                for="images">Hình ảnh:</label>
                                            <div class="col-lg-10 div-image">
                                                <div class="card" style="width: 18rem;">
                                                    <img src="{{ asset($record->image) }}" class="card-img-top" alt="...">

                                                </div>
                                                <input type="file" name="image" class="form-control">
                                                <span class="help-block">Chỉ cho phép các file ảnh có đuôi <code>jpg</code>,
                                                    <code>gif</code> và <code>png</code>. File có dung lượng tối đa
                                                    20M.</span>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4 text-left">Giá </label>
                                        <div class="col-md-5">
                                            <input type="text" name="price" class="form-control touchspin text-center"
                                                value="{{ $record->price }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4 text-left">Giá khuyến mại </label>
                                        <div class="col-md-5">
                                            <input type="text" name="sale_price" class="form-control touchspin text-center"
                                                value="{{ $record->sale_price }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4 text-left">Thời gian khuyến mại</label>
                                        <div class="col-md-5">
                                            <input type="datetime-local" name="sale_time" class="form-control"
                                                value="{{ date('Y-m-d\TH:i', strtotime($record->sale_time)) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4 text-left">Chọn giáo viên </label>
                                        <div class="col-md-5">
                                            <select required="" class="select-search form-control" multiple=""
                                                name="teacher_id[]">
                                                @foreach ($teachers as $teacher)
                                                    @if (in_array($teacher->id, explode(',', $record->teacher_id)))
                                                        <option selected="" value="{{ $teacher->id }}"><img
                                                                src={{ asset($teacher->avatar) }}>{{ $teacher->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $teacher->id }}">
                                                            <div><img src={{ asset($teacher->avatar) }}></div>
                                                            {{ $teacher->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4 text-left">Thứ tự </label>
                                        <div class="col-md-5">
                                            <input type="text" name="ordering" class="form-control touchspin text-center"
                                                value="{{ $record->ordering }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-check col-md-6 form-check-right">
                                            <label class="form-check-label float-right">
                                                Kích hoạt
                                                @if ($record->status == 1)
                                                    <input checked="" type="checkbox" class="form-check-input-styled"
                                                        name="status" data-fouc="">
                                                @else
                                                    <input type="checkbox" class="form-check-input-styled" name="status"
                                                        data-fouc="">
                                                @endif
                                            </label>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Nội dung khóa học </label>
                                        <div class="col-md-12">
                                            <textarea class="form-control ckeditor" id="content1"
                                                name="content">{!! $record->content !!}</textarea>
                                        </div>
                                    </div>
                                </div>



                                <script type="text/javascript">
                                    CKEDITOR.replace('content1', {
                                        height: 100
                                    });

                                </script>
                            </div>
                        </div>

                        <!--  <div class="tab-pane fade" id="left-icon-tab2">
                             <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-right">Thẻ tiêu đề (SEO)</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="meta_title" value="{!! $record->meta_title !!}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-right">Thẻ từ khóa (SEO) </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" value="{!! $record->meta_keywords !!}" name="meta_keywords">{!! old('meta_keywords') !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-right">Thẻ mô tả (SEO) </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control maxlength-label-position" value="{!! $record->meta_description !!}"  maxlength="255" name="meta_description">{!! old('meta_description') !!}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                         -->

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <a type="button" href="{{ route('admin.course.index', $type) }}"
                                    class="btn btn-secondary legitRipple">Hủy</a>
                                <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i
                                        class="icon-arrow-right14 position-right"></i></button>
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
