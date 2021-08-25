@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Hình ảnh</h5>
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
           <form action="{!!route('admin.gallery.update_multiple')!!}" method="POST" enctype="multipart/form-data">
            @csrf  
     <div class="card-body">
         <div class="row " style="">
            <div class="col-md-4 row">
            <label style="margin-top: 5px; font-size: 110%;" class="col-md-4">Lọc theo danh mục:</label>
            <div class="col-md-7">
             <select class="form-control select-search filter_gallery" >
                    @if(0 == $cat_id)
                    <option selected="" value="0">Tất cả danh mục</option>
                     @else
                     <option  value="0">Tất cả danh mục</option>
                     @endif
                 @foreach($categories as $cat)
                     @if($cat->id == $cat_id)
                     <option selected="" value="{{$cat->id}}">{{$cat->title}}</option>
                     @else
                     <option value="{{$cat->id}}">{{$cat->title}}</option>
                     @endif
                 @endforeach
             </select>
             </div>
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
                    <th>Tiêu đề</th>
                    <th>Ảnh</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <th><input name="check[]" type="checkbox" value="{{$record->id}}"></th>
                    <td><input type="text" class="form-control" name="title[]" value="{{$record->title}}"></td>
                    <td><img style="max-height: 100px; max-width:  150px;" src="{{asset($record->images)}}"></td>
                    <td><input style="max-width: 80px;" type="text" class="form-control" value="{{$record->ordering}}" name="orderBy[]"></td>
                    <td>
                        @if($record->status == 1)
                        <span class="badge bg-success-400">Hiển thị</span>
                        @else
                        <span class="badge bg-grey-400">Ẩn</span>
                        @endif
                    </td>
                     <td>
                        {{date('d-m-Y', strtotime($record->created_at))}}
                    </td>
                </form>
                    <td class="text-center">
                        <a href="{{route('admin.gallery.edit', $record->id)}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a>
                        <!-- <form action="{!! route('admin.gallery.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
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

    $('.filter_gallery').on('change',function(){
             //alert(window.location);
        var cat_id = $(this).val();
        var old_url = window.location.href;
         
        var main_url = old_url.split('?');
        if(cat_id != 0){
        var url = main_url[0]+"?cat_id="+cat_id;
        }else{
          var url = main_url[0];
        }
        window.location.replace(url);
         window.location.href =url;
       //location.reload();
   
    });
</script>

<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop   