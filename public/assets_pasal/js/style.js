
$(document).ready(function() {
    $('.radio').change(function ()
    {
       $('html, body').animate({
                    scrollTop: $("#form").offset().top - 200
                }, 200); 
    });
  $('.image-link').magnificPopup({type:'image'});
  $('.open-video').click(function (){
    var video = $(this).data("video");
    $('#video-player').attr('src','https://www.youtube.com/embed/'+video);
    $('.video-holder').show();
  });
  $('.video-holder').click(function(e){
    console.log(e);
    if(e.target.id != 'video-player'){
            $('.video-holder').hide();
            $('#video-player').attr('src','');
        }
  });
  $('.open-video-2').click(function (){
    var video = $(this).data("video");
    $(this).append('<iframe width="560" height="315" src="https://www.youtube.com/embed/'+video+'" autoplay="1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
  });
  $('.teacher-slide').owlCarousel({
    loop:true,
    margin:60,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav:true,
    navText: ["<img src='/assets_pasal/icon/arrow-left.png'>","<img src='/assets_pasal/icon/arrow-right.png'>"],
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
            items:3,
        }
    }
});
$('.testimonial-slide').owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
            items:3,
        }
    }
});
$('.news-slide').owlCarousel({
    loop:true,
    margin:20,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
            items:3,
        }
    }
});
 });    

var c = function() {
    return({
        log: function(msg) {
          consoleDiv = document.getElementById('console');
          para = document.createElement('p');
          text = document.createTextNode(msg);
          para.appendChild(text);
          consoleDiv.appendChild(para);
        }
    });
}();

window.onload = function () {
    var toc = "";
    var level = 0;
    var maxLevel = 3;
    if ($('#contents').length)
    {
    document.getElementById("contents").innerHTML =
        document.getElementById("contents").innerHTML.replace(
            /<h([\d])>([^<]+)<\/h([\d])>/gi,
            function (str, openLevel, titleText, closeLevel) {
                if (openLevel != closeLevel) {
				 c.log(openLevel)
                    return str + ' - ' + openLevel;
                }

                if (openLevel > level) {
                    toc += (new Array(openLevel - level + 1)).join("<ol>");
                } else if (openLevel < level) {
                    toc += (new Array(level - openLevel + 1)).join("</ol>");
                }

                level = parseInt(openLevel);

                var anchor = titleText.replace(/ /g, "_");
                toc += "<li><a href=\"#" + anchor + "\">" + titleText
                    + "</a></li>";

                return "<h" + openLevel + "><a name=\"" + anchor + "\">"
                    + titleText + "</a></h" + closeLevel + ">";
            }
        );

    if (level) {
        toc += (new Array(level + 1)).join("</ol>");
    }

    document.getElementById("toc").innerHTML += toc;
    }
};
 function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom) && (elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

$(window).scroll(function() {   
    if ($('.form-sidebar').length ){
    if(isScrolledIntoView($('.form-sidebar')))
    {   var current_width = $('.form-sidebar').width();
        $('.form-sidebar').width(current_width);
        $('.form-sidebar').addClass('fixed');
    }   
    if(isScrolledIntoView($('#ads-sidebar')))
    {  
        $('.form-sidebar').removeClass('fixed');
    }
    }
    // Get the header
    var header = document.getElementById("header-top");
    
    // Get the offset position of the navbar
    var sticky = header.offsetTop;
    if (window.pageYOffset > sticky) {
        header.classList.add("fixed-top");
      } else {
        header.classList.remove("fixed-top");
      }
});