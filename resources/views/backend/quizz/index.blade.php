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
                    <th>Thuộc bài tập</th>
                    <th>Loại test</th>
                    <th>Ngày tạo</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $key=>$record)

                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$record->title}}</td>
                    <td>{{$record->name}}</td>

                 <!--    @if($record->index == $record->dem)
                    <td>{{$record->index}}</td>
                    @elseif($record->index > $record->dem)
                    <td></td>
                    @else
                    <td>{{$record->index}} - {{$record->dem}}</td>
                    @endif -->
                    @if($record->section_type == 1)
                    <td>Listening</td>
                    @elseif($record->section_type == 2)
                    <td>Reading</td>
                    @elseif($record->section_type == 3)
                    <td>Pronunciation</td>
                    @elseif($record->section_type == 4)
                    <td>Grammar</td>
                    @elseif($record->section_type == 5)
                    <td>Vocabulary</td>
                    @endif
                    <td>{{$record->created_at}}</td>
                  
                    <td class="">
                        <a href="{{route('admin.quizz.edit',  ['id' => $record->id])}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a>
                        <form action="{!! route('admin.quizz.destroy',  ['id' => $record->id]) !!}" method="POST" style="display: inline-block">
                            {!! method_field('DELETE') !!}
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