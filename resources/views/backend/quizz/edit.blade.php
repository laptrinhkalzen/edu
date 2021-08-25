@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.quizz.update',$record->id)!!}" method="POST" enctype="multipart/form-data">
<!--  -->
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
            
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="left-icon-tab1">
                        <div class="row">
                            <div class="col-md-10" style="">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                <fieldset>
                                   <!--  <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Bài test <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="select-search form-control" readonly="" name="test_id" data-placeholder="Chọn danh mục"  required>
                                                @foreach($tests as $test)
                                                @if($test->id == $record->test_id)
                                                <option selected="" value="{{$test->id}}">{{$test->title}}</option>
                                                @else
                                                <option value="{{$test->id}}">{{$test->title}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            {!! $errors->first('category_id', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="title" value="{{$record->title}}" required="">
                                            {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                                               
                                

                                    <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Nội dung (Ảnh hoặc bảng): </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control ckeditor" id="content" name="content">{{$record->content}}</textarea>
                                        </div>
                                    </div>
                                    
                                    </div>

                                </fieldset>
                            </div>
                            <div class="col-md-10">
                             <div class="form-group row">
                                <label class="col-md-2 col-form-label text-right">Danh sách câu hỏi: </label>
                              <div class="col-md-10">
                              <div class="card" >
                              <div class="card-body">
                                <div class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Loại câu hỏi: </label>
                                        <div class="col-md-10">
                                            <select name="question_type" id="choose" class="form-control">
                                                <option select="false" value="0">Chọn loại câu hỏi</option>
                                                <option id="choice" value="1">Trắc nghiệm</option>
                                                <option id="fill_input" value="2">Điền từ</option>
                                                <option id="" value="3">True/False</option>
                                                <option id="diffirent_spell" value="4">Từ khác loại</option>
                                                <option id="connect" value="5">Nối từ</option>
                                                
                                            </select>
                                        </div>
                                </div>
                                <div id="question_div" style="display: none;" class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Câu hỏi: </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" id="question" rows="4"></textarea>
                                        </div>
                                </div>
                                 <div id="fill_answer" style="display: none;" class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Câu trả lời: </label>
                                        <div class="col-md-10">
                                            <input name="answer_text" placeholder="Các đáp án cách nhau bởi dấu phẩy" id="answer" class="form-control" value="">
                                        </div>
                                </div>
                              
                                 <div id="choice_answer" style="display: none;" class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Câu trả lời</label>
                                    <div class="input_fields_wrap col-md-10 row">
                                        <div class="col-md-12 row" style="margin-bottom: 10px;">
                                       <input type="radio" class="col-md-1 this_answer" name="this_answer" style="margin-top: 7px;" value="0">
                                       <input type="text" class="form-control col-md-9  list_answer">
                                       <button style="margin-left: 10px;" type="button" class="btn btn-primary add_field_button" name="">Add</button>
                                        </div>
                                    </div>
                               </div>

                                 <div id="true_false" style="display: none;" class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Chọn đáp án</label>
                                    <select name="answer_select" class="form-control col-md-10 " id="answer_select">
                                        <option selected="" value="true">True</option>
                                        <option value="false">False</option>
                                        <option value="not_given">Not Given</option>
                                    </select>
                               </div>
                                 <div id="ordering"  class="form-group row">
                                        <label class="col-md-2 col-form-label text-right">Thứ tự: </label>
                                        <div class="col-md-10">
                                            <input name="ordering" id="answer" class="form-control" value="0">
                                        </div>
                                </div>

                               <div class="form-group row">
                                    <table class="table">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Câu hỏi</th>
                                          <th scope="col">Câu trả lời</th>
                                           <th scope="col">Thứ tự</th>
                                          <th scope="col">Thao tác</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                       @foreach($questions as $key => $question)
                                           <tr>
                                              <td scope="col">{{++$key}}</td>
                                              <td scope="col">{{$question->question}}</td>
                                             
                                              @if($question->question_type == 1 || $question->question_type == 4)
                                               <td scope="col">
                                              @foreach(explode(",", $question->list_answer) as $val)
                                                @if($val == $question->answer)
                                                <b>{{$val}}</b><br>
                                                @else
                                                {{$val}}<br>
                                                @endif
                                              @endforeach
                                              </td>
                                              @else
                                              <td scope="col">{{$question->answer}}</td>
                                              
                                              @endif
                                               <td scope="col">{{$question->ordering}}</td>
                                              <td class="">
                                               <a href="#" data-toggle="modal" data-target="#exampleModalCenter_{{$key}}"><i class="icon-pencil"></i></a><a href="{{route('admin.quizz.edit',  ['id' => $question->id])}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-close2" style="color:red;"></i></a>            
                                                </form>
                                            </td>
                                           </tr>
                                           <!-- Button trigger modal -->

                                            <!-- Modal -->
                                        <form action="{!!route('admin.question.update',$question->id)!!}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                        <input type="hidden" name="question_type" value="{{$question->question_type}}">
                                        <div class="modal fade" id="exampleModalCenter_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Chỉnh sửa câu hỏi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                    @if($question->question_type == 1 || $question->question_type==4)
                                                    <div class="form-group row col-md-12">
                                                        <label class="col-md-2">Câu hỏi</label>
                                                        <input type="text" class="form-control col-md-9" value="{{$question->question}}" name="question">
                                                    </div>  
                                                    <div class=" form-group   row col-md-12">  
                                                        @foreach(explode(",", $question->list_answer) as $key => $val)
                                                            @if($val == $question->answer)
                                                           <input style="height: 1em; margin-top: 10px;" checked="" type="radio" class="form-control col-md-2" name="answer_radio" value="{{$key}}"><input style="margin-bottom: 10px;" type="text" value="{{$val}}" class="form-control col-md-10" name="list_answer[]" value="{{$question->question}}">
                                                            @else
                                                             <input style="height: 1em; margin-top: 10px;" type="radio" class="form-control col-md-2" name="answer_radio"  value="{{$key}}"><input style="margin-bottom: 10px;" type="text" value="{{$val}}" class="form-control col-md-10" name="list_answer[]">
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    @elseif($question->question_type == 2 || $question->question_type == 5)
                                                     <div class="form-group row col-md-12">
                                                        <label class="col-md-2">Câu hỏi</label>
                                                        <input type="text" class="form-control col-md-9" value="{{$question->question}}" name="question">
                                                    </div>  
                                                    <div class=" form-group   row col-md-12">  
                                                        <label class="col-md-2">Câu trả lời</label>
                                                        <input type="text" class="form-control col-md-9" value="{{$question->answer}}"  name="answer">
                                                    </div>
                                                    @elseif($question->question_type == 3)
                                                     <div class="form-group row col-md-12">
                                                        <label class="col-md-2">Câu hỏi</label>
                                                        <input type="text" class="form-control col-md-9" value="{{$question->question}}" name="question">
                                                    </div>  
                                                    <div class=" form-group   row col-md-12">  
                                                       <label class="col-md-2">Câu trả lời</label>
                                                       <select name="answer" class="form-control col-md-10 " id="answer_select">
                                                          <option selected="" value="true">True</option>
                                                          <option value="false">False</option>
                                                          <option value="not_given">Not Given</option>
                                                      </select>
                                                    </div>
                                                    @endif
                                                     <div class=" form-group   row col-md-12">  
                                                       <label class="col-md-2">Thứ tự</label>
                                                      <input class="col-md-9 form-control" value="{{$question->ordering}}" type="text" name="ordering">
                                                    </div>
                                              </div>
                                              <div style="margin-top: 25px; " class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                       @endforeach
                                      </tbody>
                                    </table>
                               </div>

                                    <div class="text-center">
                                        <button type="button" id="create_question" class="btn btn-primary legitRipple">Thêm câu hỏi<i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                           
                              </div>
                                </div>
                            </div>
                        </div>
                    </div>

                 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a type="button" href="{{route('admin.quizz.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
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
<script type="text/javascript">
    $(document).ready(function() {
        var question_type;
         
    $('#choose').on('change',function(){
        question_type = $(this).val();
        if(question_type==1){
          question_div
           $('#question_div').show();
            $('#choice_answer').show();
            $('#fill_answer').hide();
             $('#true_false').hide();
            
        }else if(question_type==2){
          $('#question_div').show();
            $('#choice_answer').hide();
            $('#fill_answer').show();
             $('#true_false').hide();
        }else if(question_type==3){
          $('#question_div').show();
            $('#choice_answer').hide();
            $('#fill_answer').hide();
            $('#true_false').show();
        }
        else if(question_type==4){
          $('#question_div').hide();
            $('#choice_answer').show();
            $('#fill_answer').hide();
            $('#true_false').hide();
        }else if(question_type==5){
          $('#question_div').show();
            $('#choice_answer').hide();
            $('#fill_answer').show();
             $('#true_false').hide();
        }
    });
    
    $('#create_question').on('click',function(){
        var data = [];  //cau trả lời
        var ordering = $('#ordering').val(); 
        var question = $('#question').val();   //Câu hỏi
        var quizz_id = {{$record->id}};        //Nhóm câu hỏi
        var radioValue =$('input[name=this_answer]:checked').val()    //Đáp án đúng trắn nghiệm
        var true_false = $("#answer_select :checked").val();   //ĐÁp án true_falsse
        var key = 2;                                        
        var answer =  $('#answer').val();   //Câu trả lời text               
        if(question_type == 1 || question_type == 4 ){
        $(".list_answer").each(function () {                  
            data.push($(this).val()); 
         });
         }else{
            var data = $('#answer').val();
         }      
        $.ajax({
                url:'{{route("api.create_question")}}',
                method:"POST",
                dataType: "JSON",
                data:{data:data,question_type:question_type,question:question,quizz_id:quizz_id,radioValue:radioValue,answer:answer,true_false:true_false,ordering:ordering},
                success:function(resp){
                    window.location.reload();
                    // key ++;
                    // var html="";
                    // html += "<tr>";
                    // html += '<td>'+key+'</td>';
                    // html += '<td>'+resp.record.question+'</td>';
                    // html += '<td>'+resp.record.answer+'</td>';
                    // html += '<td class=""><a href="{{route('admin.quizz.edit',  ['id' => $record->id])}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-pencil"></i></a><a href="{{route('admin.quizz.edit',  ['id' => $record->id])}}" title="{!! trans('base.edit') !!}" class="success"><i class="icon-close2" style="color:red;"></i></a></td>';
                    // html += "</tr>";
                    // $('tbody').append(html);
                   }
        });  
    });

    //    $('#update_question').on('click',function(){
    //     var data = [];  //cau trả lời
    //     var ordering = $('#ordering').val(); 
    //     var question = $('#question').val();   //Câu hỏi
    //     var quizz_id = {{$record->id}};        //Nhóm câu hỏi
    //     var radioValue =$('input[name=this_answer]:checked').val()    //Đáp án đúng trắn nghiệm
    //     var true_false = $("#answer_select :checked").val();   //ĐÁp án true_falsse                                       
    //     var answer =  $('#answer').val();   //Câu trả lời text               
    //     if(question_type == 1 || question_type == 4 ){
    //     $(".list_answer").each(function () {                  
    //         data.push($(this).val()); 
    //      });
    //      }else{
    //         var data = $('#answer').val();
    //      }      
    //     $.ajax({
    //             url:'{{route("api.update_question")}}',
    //             method:"POST",
    //             dataType: "JSON",
    //             data:{data:data,question_type:question_type,question:question,quizz_id:quizz_id,radioValue:radioValue,answer:answer,true_false:true_false,ordering:ordering},
    //             success:function(resp){
    //                 window.location.reload();
    //                }
    //     });  
    // });



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
    })
});
</script>
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
