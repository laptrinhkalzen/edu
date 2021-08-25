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

        <div style="margin-left: 30px;" class="row">
            <button type="button" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#exampleModalCenter">
              Thêm câu hỏi listen
            </button>
              <button type="button" style="margin-left: 20px;" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#exampleModalCenter1">
              Thêm câu hỏi reading
            </button>
        </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Listen question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
              
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                      <li><a class="active" href="#choose_answer" role="tab" data-toggle="tab">Chọn đáp án đúng</a></li>
                      <li class=""><a href="#fill_word" role="tab" data-toggle="tab">Điền từ</a></li>
                      <li class=""><a href="#chart" role="tab" data-toggle="tab">Biểu đồ</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane active" id="choose_answer">
                        <form action="{!!route('admin.question.store')!!}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="question_type" value="1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Chọn đề test: </label>
                                    <div class="col-md-8">
                                        <select name="test_id" class="form-control">
                                            @foreach($tests as $test)
                                            <option value="{{$test->id}}">{{$test->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Câu hỏi: </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="question">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 row">
                                <label class="col-md-2 col-form-label text-right">Câu trả lời</label>
                                <div class="input_fields_wrap row">
                                   <div class="col-md-12 row" style="margin-bottom: 10px;">
                                   <input type="radio" class="col-md-1" style="margin-top: 7px;" value="0" name="is_answer">
                                   <input type="text" class="form-control col-md-11" name="list_answer[]">
                                    </div>

                                   <div class="col-md-12 row" style="margin-bottom: 10px;">
                                   <input type="radio" class="col-md-1" style="margin-top: 7px;" value="1" name="is_answer">
                                   <input type="text" class="form-control col-md-11" name="list_answer[]">
                                    </div>

                                   <div class="col-md-12 row" style="margin-bottom: 10px;">
                                   <input type="radio" class="col-md-1" style="margin-top: 7px;" value="2" name="is_answer">
                                   <input type="text" class="form-control col-md-11" name="list_answer[]">
                                    </div>
                               </div>
                            </div>
                        </div>
                         <div class="col text-center">
                        <button type="submit" class="btn btn-primary text-center">Lưu lại</button>
                    </div>
                       </form>
                      </div>
                      <div class="tab-pane" id="fill_word">
                        <form action="{!!route('admin.question.store')!!}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="question_type" value="2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Chọn đề test: </label>
                                    <div class="col-md-8">
                                        <select name="test_id" class="form-control">
                                            @foreach($tests as $test)
                                            <option value="{{$test->id}}">{{$test->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 row">
                                <label class="col-md-2 col-form-label text-right">Câu trả lời</label>
                                <div class="input_fields_wrap row">
                                   <div class="col-md-12 row" style="margin-bottom: 10px;">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                               </div>
                            </div>
                        </div>
                         <div class="col text-center">
                        <button type="submit" class="btn btn-primary text-center">Lưu lại</button>
                    </div>
                       </form>
                      </div>
                    </div>

                </div>
              </div>
            </div>
             <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
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

        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Câu hỏi</th>
                    <th>Câu trả lời</th>
                    <th>Đáp án</th>
                    <th>Ngày tạo</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$record->title}}</td>
                    <td>{{$record->question}}</td>
                    <td>{{$record->question}}</td>
                    <td>{{$record->answer}}</td>
                    <td>{{$record->created_at}}</td>
                  
                    <td class="">
                        <a href="{{route('admin.question.edit', $record->id)}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a>
                       <!--  <form action="{!! route('admin.test.destroy', ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
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
    $(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            var html = "";
             html += '<div class="col-md-12 row" style="margin-bottom: 10px;">';
             html +='<input type="radio" class="col-md-1" style="margin-top: 7px;" name="is_answer[]">'; 
             html += '<input type="text" class="form-control col-md-8" name="mytext[]">';
             html += '<a href="#" class="remove_field">Xoá</a>';
             html += '</div>';
            $(wrapper).append(html); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
<script src="{!! asset('assets/global_assets/js/plugins/tables/datatables/datatables.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/datatables_basic.js') !!}"></script>
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script> 
@stop   