<!-- Page header -->
@if($parent_route!=='admin.index')

<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> 
                <span class="font-weight-semibold">Trang chủ</span> - {{trans('route.'.$parent_route)}}
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                @if($method == 'index')
                
                @if (\Route::has(str_replace('index', 'create', $current_route)))

                @if(isset($type))

               
                <a href="{!!route(str_replace('index', 'create', $current_route), ['type'=> $type])!!}" class="btn btn-link btn-float text-default"><i class="icon-googleplus5 text-primary"></i><span>Thêm mới</span></a>

                @else
                <a href="{!!route(str_replace('index', 'create', $current_route))!!}" class="btn btn-link btn-float text-default"><i class="icon-googleplus5 text-primary"></i><span>Thêm mới</span></a>
                @endif
                @endif
                @else
                
                @endif         
            </div>
        </div>
    </div>


</div>
@endif
<!-- //<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript">
    $('.select-search').select2({});
</script>
<!-- /page header -->