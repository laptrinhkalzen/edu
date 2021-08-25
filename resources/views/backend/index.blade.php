@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-sm-4">
            <a href="">
                <div class="tile-stats tile-red"> 
                    <div class="icon"><i class="icon-bag"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="3350" data-postfix="" data-duration="1500" data-delay="0">
                        10                     </div>
                    <h3>Khoá học</h3>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="">
                <div class="tile-stats tile-aqua"> 
                    <div class="icon"><i class="icon-newspaper"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="85" data-postfix="" data-duration="1500" data-delay="0">
                        10</div>
                    <h3>Giảng viên</h3>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="">
                <div class="tile-stats tile-green"> 
                    <div class="icon"><i class="icon-bubble-dots4"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">
                        10
                    </div>
                    <h3>Học viên</h3>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /content area -->
@stop
