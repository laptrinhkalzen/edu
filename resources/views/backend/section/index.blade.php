@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<style type="text/css">
    li{
        margin-right: 15px;
    }
</style>
<div class="content">
    <!-- Table header styling -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Câu hỏi </h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

     
        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert bg-success alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ Session::get('success') }}</span>
            </div>
            @endif
             @if (Session::has('error'))
            <div class="alert bg-danger alert-styled-left">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ Session::get('error') }}</span>
            </div>
            @endif
        </div>
        <form action="{!!route('admin.section.update_multiple')!!}" method="POST" enctype="multipart/form-data">
            @csrf  
  <div class="card-body">
         <div class="row " style="">
           <!--  -->
          <div class="col-md-6">
            
            <div class="row">
              <label style="margin-top: 5px;" class="col-md-2">Quản lý Score:</label>
                <button style="margin-right: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_1">
                  Pronunciation
                </button>
                <button style="margin-right: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_2">
                  Grammar
                </button>
                <button style="margin-right: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_3">
                  Vocabulary
                </button>
                <button style="margin-right: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_4">
                  Listening
                </button>
                <button style="margin-right: 5px;"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter_5">
                  Reading
                </button>
            </div>
          </div>
          @php
             $index = 0;
          @endphp

          @for($i = 1; $i<=5; $i++)
          @php

          if($i == 1){
             $index = 3;
          }
          elseif($i == 2){
             $index = 4;
          }
          elseif($i == 3){
             $index = 5;
          }
          elseif($i == 4){
             $index = 1;
          }
          elseif($i == 5){
             $index = 2;
          }

          @endphp

          <div class="modal fade" id="exampleModalCenter_{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Quản lý score</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                     <div class="row">                     
                         <table class="table">
                          <thead>
                             <tr>
                                <th scope="col">Số câu từ</th>
                                <th scope="col">Đến câu</th>
                                <th scope="col">Điểm</th>
                                <th scope="col">Đánh giá</th>
                                 <th scope="col">Tác vụ</th>
                            </tr>
                           </thead>
                           <tbody>
                           @foreach($scores as $score)
                              @if($score->type == $index)
                                <tr>
                                  <th scope="row">{{$score->from}}</th>
                                  <th scope="row">{{$score->to}}</th>
                                  <td>{{$score->score}}</td>
                                  <td>{!!$score->content!!}</td>
                                  <td><a href="{{route('admin.score.edit',$score->id)}}">Sửa</a></td>
                                </tr>
                               @endif
                            @endforeach
                         </tbody>
                       </table>
                    </div>
                 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">Lưu</button>
                  <button type="button" class="btn btn-primary"><a style="color:white;" href="{{route('admin.score.create',$index)}}">Thêm mới</a></button>
                </div>
              </div>
            </div>
          </div>
          @endfor

          <script type="text/javascript">
            var max_fields = 5; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID
            
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                     //text box increment
                    var html = "";
                     html += '<div class="col-md-12 row" style="margin-bottom: 10px;">';
                     html +='<input type="radio" name="this_answer"  value="'+x+'" class="col-md-1 this_answer" style="margin-top: 7px;">'; 
                     html += '<input type="text" class="form-control col-md-9 list_answer">';
                     html += '<a style="margin-left: 5px; margin-top: 5px;" href="#" class="remove_field">Xoá</a>';
                     html += '</div>';
                    $(wrapper).append(html); //add input box
                    x++;
                }
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            });
       
          </script>
         <div class="col-md-6">
             <div class="row" style="float: right;">
                 <button style="margin-right: 5px;" name="action" value="save" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
                 <button style="margin-right: 5px;" name="action" value="delete" class="btn btn-primary"><i class="fa fa-trash-o" aria-hidden="true"></i> Xoá</button>
                 <!-- <button style="margin-right: 5px;" name="action" value="active" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Kích hoạt</button>
                 <button style="margin-right: 5px;" name="action" value="unactive" class="btn btn-primary"><i class="fa fa-minus" aria-hidden="true"></i> Ngưng kích hoạt</button> -->
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
                    <th>Thể loại</th>
                    <th>Số câu hỏi</th>
                    <th>Ví trí</th>
                    <th>Ngày tạo</th>
                    
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <th><input name="check[]" type="checkbox" value="{{$record->id}}"></th>
                    <td>{{$record->name}}</td>
                    @if($record->section_type==1)
                    <td>Listening (Tổng {{$eachs[$record->section_type]->dem}} câu)</td>
                    @elseif($record->section_type==2)
                    <td>Reading (Tổng {{$eachs[$record->section_type]->dem}} câu)</td>
                    @elseif($record->section_type==3)
                    <td>Pronunciation (Tổng {{$eachs[$record->section_type]->dem}} câu)</td>
                    @elseif($record->section_type==4)
                    <td>Gramma (Tổng {{$eachs[$record->section_type]->dem}} câu)</td>
                    @elseif($record->section_type==5)
                    <td>Vocabulary (Tổng {{$eachs[$record->section_type]->dem}} câu)</td>
                    @endif
                    @php
                    $dem = 0;
                    @endphp
                    @foreach($quizzs as $quizz)
                       @if($quizz->section_id == $record->id)
                       @php
                          $dem++;
                       @endphp   
                       @endif
                    @endforeach
                    <td>{{$dem}}</td>
                    <td><input type="text" class="form-control" style="max-width: 70px;" name="orderBy[]" value="{{$record->ordering}}"></td>
                    <td>{{$record->created_at}}</td>
                    
                   
                </form>
                    <td class="">
                        <a href="{{route('admin.section.edit',  ['id' => $record->id])}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a>
                        <form action="{!! route('admin.section.destroy',  ['id' => $record->id]) !!}" method="post" style="display: inline-block">
                            {!! csrf_field() !!}
                            <a title="{!! trans('base.delete') !!}" class="delete text-danger" data-action="delete">
                                <i class="icon-close2"></i>
                            </a>              
                        </form>
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

    $('.filter_new').on('change',function(){
             //alert(window.location);
        var test_id = $(this).val();
        var old_url = window.location.href;
         
        var main_url = old_url.split('?');
        if(test_id != 0){
        var url = main_url[0]+"?test_id="+test_id;
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
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script> 
@stop   