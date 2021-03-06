function getAjax(url, data, method = "post", dataType = "JSON") {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        dataType: dataType
    });
}
$(document).ready(function () {
    $('select').niceSelect();
    var xhr;
    $('#autoComplete').autoComplete({
        minChars: 1,
        source: function (term, response) {
            term = term.toLowerCase();
            try {
                xhr.abort();
            } catch (e) {
            }
            xhr = getAjax('/api/get-products', {keyword: term}, 'post').done(function (data) {
                response(data);
            });
        }
    });
    if ($('.all-attributes').length) {
        getAjax('/api/get-product-attribute', {ids: $('.attribute_id').val(), category_id: $('.category_id').val()}).done(function (resp) {
            $('.all-attributes').html(resp.html);
            $('.list-attribute').slimScroll({
                height: '350px'
            });
        });
    }

    $('body').delegate('[type="checkbox"]', 'change', function () {
        var ids = [];
        $('.attribute_select:checked').each(function () {
            ids.push($(this).val());
        })
        $('.attribute_id').val(ids.join(','));
        $(this).parents('form').submit();
    });
    if ($('.recent-post').length) {
        getAjax('/api/get-recent-post', {page: 0}).done(function (resp) {
            $('.recent-post').html(resp.html);
        });
        var page = 0;
        $(window).scroll(function () {
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 50) {
                ++page;
                getAjax('/api/get-recent-post', {page: page}).done(function (resp) {
                    $('.recent-post').append(resp.html);
                });
            }
        });
    }

    $('.login').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
    });
    $('.register').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade'
    });

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
    // $('.has-menu').on('click', function () {
    //     $('.menu-child').toggleClass('menu-child-open');
    // })
    $(".has-menu").on('click', function () {
        $(this).toggleClass('active');
        $(this).find('.menu-child').slideToggle();
    });
});
$('#newsletter_form').submit(function (e) {
    e.preventDefault();
    getAjax('/api/add-subscriber', $(this).serialize()).done(function (resp) {
        if (resp.success === true) {
            swal({
                title: "Ch??c m???ng b???n ???? ????ng k?? nh???n tin th??nh c??ng",
                icon: "success"
            });
        }
        $('#newsletter_form')[0].reset();
    })
});
$('#password1').change(function () {
    if ($(this).val().length < 6) {
        var span = "Nh???p m???t kh???u t???i thi???u 6 k?? t???";
        $(this).parent().find('.help-block').html(span);
    } else {
        $('.help-block').html('');
    }
});
$('#password2').change(function (e) {
    if ($(this).val() != $('#password1').val()) {
        var span = "Nh???p l???i m???t kh???u kh??ng tr??ng kh???p";
        $(this).parent().find('.help-block').html(span);
    } else {
        $('.help-block').html('');
    }
});

$('#username1').change(function () {
    var username = $(this).val();
    var $this = $(this);
    var type = $('input[name="type"]:checked').val();
    if (type == 1) {
        $.ajax({
            url: '/api/check-user-marketing',
            method: 'POST',
            data: {username: username, _token: $('#token').val()},
            dataType: 'JSON',
            success: function (resp) {
                if (resp.success == false) {
                    var span = "Username ???? t???n t???i";
                    $this.parent().find('.help-block').html(span);
                } else {
                    $('.help-block').html('');
                }
            }
        });
    } else {
        $.ajax({
            url: '/api/check-user-construction',
            method: 'POST',
            data: {username: username, "_token": $('#token').val()},
            dataType: 'JSON',
            success: function (resp) {
                if (resp.success == false) {
                    var span = "Username ???? t???n t???i";
                    $this.parent().append(span);
                } else {
                    $('.help-block').remove();
                }
            }
        });
    }
})
$('#frmRegister').submit(function (e) {
    e.preventDefault();
    var type = $('input[name="type"]:checked').val();
    $('.load').css('display', 'block');
    $('.register-btn').attr("disabled", "disabled");
    if (type == 1) {
        $.ajax({
            url: '/api/register-marketing',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "????ng k?? t??i kho???n th??nh c??ng. B???n vui l??ng v??o gmail ????? x??c th???c t??i kho???n",
                    type: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    } else {
        $.ajax({
            url: '/api/register-construction',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.load').css('display', 'none');
                $('.register-btn').removeAttr("disabled", "");
                $('.login').magnificPopup('close');
                swal({
                    title: "????ng k?? t??i kho???n th??nh c??ng. B???n vui l??ng v??o gmail ????? x??c th???c t??i kho???n",
                    icon: "success"
                });
                $('#frmRegister')[0].reset();
            }
        });
    }
});
$('#frmLogin').submit(function (e) {
    e.preventDefault();
    var type = $('input[name="type_login"]:checked').val();
    if ($('#username').val() == '') {
        var span = "Username kh??ng ???????c ????? tr???ng";
        $('#username').parent().find('.help-block').html(span);
        return;
    }
    if ($('#password').val().length < 6) {
        var span = "Nh???p m???t kh???u t???i thi???u 6 k?? t???";
        $('#password').parent().find('.help-block').html(span);
        return;
    }
    if (type == 1) {
        $.ajax({
            url: '/api/login-marketing',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "????ng nh???p th??nh c??ng",
                        type: 'success'
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "????ng nh???p kh??ng th??nh c??ng",
                        type: 'error'
                    });
                }
            }
        });
    } else {
        $.ajax({
            url: '/api/login-construction',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (resp) {
                $('.login').magnificPopup('close');
                if (resp.success == true) {
                    swal({
                        title: "????ng nh???p th??nh c??ng",
                        type: "success"
                    }, function () {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "????ng nh???p kh??ng th??nh c??ng",
                        type: "error"
                    });

                }
            }
        });
    }
});

$('.news-owl-carousel.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    dots: false,
    nav: true,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
});
$('.quantity').change(function () {
    var product_id = $(this).data('product_id');
    var quantity = $(this).val();
    $.ajax({
        url: '/api/update-cart',
        method: 'POST',
        data: {product_id: product_id, quantity: quantity},
        success: function (resp) {
            if (resp.success == true) {
                $('.itm-cont').html(resp.count);
                $('#total').html(resp.total + ' ??');
                swal('L??u th??nh c??ng');
            } else {
                swal('L??u th???t b???i');
            }
        }
    });
})
$('.delete').click(function () {
    var product_id = $(this).data('product_id');
    $.ajax({
        url: '/api/delete-cart',
        method: 'POST',
        data: {product_id: product_id},
        success: function (resp) {
            if (resp.success == true) {
                $('.itm-cont').html(resp.count);
                $('#total').html(resp.total + ' ??');
            }
        }
    });
    $('#product_' + product_id).fadeOut();
});
$('.video-owl-carousel.owl-carousel').each(function () {
    var ifMultiple = false;
    $thisGallery = $(this);
    if ($thisGallery.children('.item').length > 3) {
        ifMultiple = true;
    }
    $thisGallery.owlCarousel({
        loop: ifMultiple,
        margin: 10,
        dots: false,
        nav: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
});
function validate_select() {
    var contact = document.form.contact.value;
    var mobile = document.form.mobile.value;
    var email = document.form.email.value;
    var address = document.form.address.value;
    var payment_method = document.form.payment_method.value;
    var transport_method = document.form.transport_method.value;
    $('.input-name .help-block').remove();
    if (contact == '')
    {
        var span = "<span class='help-block'>Xin h??y ??i???n ?????y ????? th??ng tin</span>";
        $(".input-name").append(span);
        return false;
    }
    if (mobile == '')
    {
        var span = "<span class='help-block'>Xin h??y ??i???n ?????y ????? th??ng tin</span>";
        $(".input-mobile").append(span);
        return false;
    }
    if (email == '')
    {
        var span = "<span class='help-block'>Xin h??y ??i???n ?????y ????? th??ng tin</span>";
        $(".input-email").append(span);
        return false;
    }
    if (payment_method == 0)
    {
        var span = "<span class='help-block'>Xin h??y ch???n ph????ng th???c thanh to??n</span>";
        $(".select_payment").append(span);
        return false;
    }
    if (transport_method == 0)
    {
        var span = "<span class='help-block'>Xin h??y ch???n ph????ng th???c v???n chuy???n</span>";
        $(".select_transport").append(span);
        return false;
    }
    if (address == '')
    {
        var span = "<span class='help-block'>Xin h??y ??i???n ?????y ????? th??ng tin</span>";
        $(".input-address").append(span);
        return false;
    }
    return true;
}
$(window).scroll(function () {
    if ($(this).scrollTop() > 100)
        $("#toTop").fadeIn();
    else
        $("#toTop").fadeOut();
});
$("#toTop").click(function () {
    $("body,html").animate({scrollTop: 0}, "slow");
});

$('.item-list').slimScroll({
    height: '350px'
});