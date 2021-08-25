$(document).ready(function() {
    $('.navigation a').click(function (){
        $('.navigation a').removeClass('active');
        $(this).addClass('active');
    });
});
jQuery(function(){
    $('#read-detail').click(function (){
        $('.product-detail').attr('style',  'max-height:1000px');
        $('.maskcontent').hide();
        $(this).hide();
        $('#collapse-detail').show();
    });
    $('#collapse-detail').click(function(){
        $('.product-detail').attr('style',  'max-height:250px');
        $('.maskcontent').show();
        $(this).hide();
        $('#read-detail').show();
    });


});
$('a[data-action ="add-to-cart"]').click(function(){
     var product_id=$(this).data('product_id');
     var quantity=$('#quantity').val();
     $.ajax({
            url:'/api/add-to-cart',
            method:'POST',
            data:{product_id : product_id,quantity:quantity},
            success:function(resp){
               if(resp.success == true){
                 $('.itm-cont').html(resp.count);
                 $('#total').html(resp.total +' đ');
                 swal('Thêm giỏ hàng thành công');
               }else{
                 swal('Thêm giỏ hàng không thành công');  
               }
            }
        });
     
 })

$(document).ready(function(){
    var menu_sidebar_btn = $('.hamburger.hamburger--spin');
    var menu_sidebar = $('.menu-sidebar');
    var menu_sidebar_overlay = $('.menu-sidebar-overlay');
    var menu_sidebar_close = $('.menu-sidebar-close');
    /*menu sidebar toggle*/
    menu_sidebar_btn.on('click', function () {
        $(this).toggleClass('active');
        menu_sidebar.toggleClass('menu-sidebar-open');
        menu_sidebar_overlay.toggleClass('menu-sidebar-overlay-active');

    });
    /*menu sidebar close*/
    menu_sidebar_close.on('click', function () {
        menu_sidebar_btn.removeClass('active');
        menu_sidebar.removeClass('menu-sidebar-open');
        menu_sidebar_overlay.removeClass('menu-sidebar-overlay-active');
    });

    menu_sidebar_overlay.on('click', function () {
        menu_sidebar_btn.removeClass('active');
        menu_sidebar.removeClass('menu-sidebar-open');
        menu_sidebar_overlay.removeClass('menu-sidebar-overlay-active');
    });
    $(".has-menu").on('click', function () {
        $(this).toggleClass('active');
        $(this).find('.menu-child').slideToggle();
    });

    $('#big').owlCarousel({
        slideSpeed: 2000,
        nav: true,
        autoplay: true,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
        ]
    });
});

