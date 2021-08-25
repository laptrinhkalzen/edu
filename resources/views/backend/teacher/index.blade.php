@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Danh sách giảng viên </h5>
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
            @endif
        </div>
        <form action="{!!route('admin.teacher.update_multiple')!!}" method="POST" enctype="multipart/form-data">
            @csrf  
             <div class="card-body">
                 <div class="row " style="">
                    <div class="col-md-4">
                    </div>
                 <div class="col-md-8">
                     <div class="row" style="float: right;">
                         <button style="margin-right: 5px;" name="action" value="save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
                         <button style="margin-right: 5px;" name="action" value="delete" class="btn btn-primary"><i class="fa fa-trash-o" aria-hidden="true"></i> Xoá</button>
                         <button style="margin-right: 5px;" name="action" value="active" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Kích hoạt</button>
                         <button style="margin-right: 5px;" name="action" value="unactive" class="btn btn-primary"><i class="fa fa-minus" aria-hidden="true"></i> Ngưng kích hoạt</button>
                     </div>
                 </div>
             </div>
         </div>
        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th><input type="checkbox" id="select_all" value=""></th>
                    <th>Avatar</th>
                    <th>Tên giáo viên</th>
                    <th>Thứ tự</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <th><input name="check[]" type="checkbox" value="{{$record->id}}"></th>
                    @if($record->avatar == null)
                    <td><img src="{{url('/img/avt.png')}}" class="img-thumbnail" id ="frame" alt="Giảng viên" width="100" height="100" /></td>
                    @else
                    <td><img class="img-thumbnail" style="width: 100px; height: 100px;" src="{{asset($record->avatar)}}"></td>
                    @endif
                    <td>{{$record->name}}</td>
                    <td><input type="text" class="form-control" style="max-width: 70px;" name="orderBy[]" value="{{$record->ordering}}"></td>
                    <td>{{date('d-m-Y', strtotime($record->created_at))}}</td>
                    <td>
                        @if($record->status == 1)
                        <span class="badge bg-success-400">Kích hoạt</span>
                        @else
                        <span class="badge bg-grey-400">Khoá</span>
                        @endif
                    </td>
                </form>
                    <td class="">
                        <a href="{{route('admin.teacher.edit', $record->id)}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a>
                     <!--    <form action="{!! route('admin.teacher.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <a title="{!! trans('base.delete') !!}" class="delete text-danger" data-action="delete">
                                <i class="icon-close2"></i>
                            </a>              
                        </form> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /table header styling -->

</div>
<!-- /content area -->
@stop
@section('script')
@parent
<script type="text/javascript">
    $('#select_all').click(function() {
      var c = this.checked;
      $(':checkbox').prop('checked', c);
});
</script>
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop   