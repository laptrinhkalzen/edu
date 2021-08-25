@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Khoá học </h5>
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
       <form action="{!!route('admin.course.update_multiple')!!}" method="POST" enctype="multipart/form-data">
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
        <!-- Button trigger modal -->


<!-- Modal -->

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th><input type="checkbox" id="select_all" value=""></th>
                    <th>Tiêu đề</th>
                    <th>Ngày tạo</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th>Ưu đãi</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <th><input name="check[]" type="checkbox" value="{{$record->id}}"></th>
                    <td>{{$record->title}}</td>
                    <td>{{date('d-m-Y', strtotime($record->created_at))}}</td>
                    <td><input style="max-width: 80px;" type="text" class="form-control" value="{{$record->ordering}}" name="orderBy[]"></td>
                    <td>
                        @if($record->status == 1)
                        <span class="badge bg-success-400">Hiển thị</span>
                        @else
                        <span class="badge bg-grey-400">Ẩn</span>
                        @endif
                    </td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModalCenter_{{$key}}">
                          Ưu đãi
                        </button></td>
                  <div class="modal fade" id="exampleModalCenter_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ưu đãi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                         <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Giá </label>
                                    <div class="col-md-5">
                                        <input type="text" id="price_{{$key}}" name="" class="form-control touchspin text-center" value="{{$record->price}}">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Giá khuyến mại </label>
                                    <div class="col-md-5">
                                        <input type="text" id="sale_price_{{$key}}" name="" class="form-control touchspin text-center" value="{{$record->sale_price}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-left">Thời gian khuyến mại</label>
                                    <div class="col-md-5">
                                        <input type="date" id="sale_time_{{$key}}" name="" class="form-control" value="{{$record->sale_time}}">
                                    </div>
                                </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_promo" data-id="{{$record->id}}" data-key="{{$key}}">Lưu</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
                    <td class="">
                        <a href="{{route('admin.course.edit', $record->id)}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a>
                        
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

    $('.save_promo').click(function() {
          var key = $(this).data('key');
          var id = $(this).data('id');
          var price = $('#price_'+key).val();
          var sale_price = $('#sale_price_'+key).val();
          var sale_time = $('#sale_time_'+key).val();
          $.ajax({
             url: "{{route('api.update_promo')}}",
              type: "POST",
              data: {price : price, sale_price:sale_price, sale_time:sale_time, id:id},
              success: function(data){
                if(data.success == 1){
                 //$('#exampleModalCenter_'+key).hide();
                 alert('Cập nhật ưu đãi thành công');
                }
                else{
                     alert('Cập nhật thất bại');
                }
              }
          });
    });
</script>


<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
@stop   