$(document).ready(function () {
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $('#backTop').fadeIn();
        } else {
            $('#backTop').fadeOut();
        }
    });
    $('#backTop').click(function () {
        $('#backTop').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    
    $('#backTop').tooltip('show');

    // thay đổi mũi tên lên, xuống của left_menu trong mobile 
    $(".left_menu_mobile").on("click", function(){
        var flagCollapse = $("#menu_arrow_down").attr("value");
        if(flagCollapse == "0")
        {
            $("#menu_arrow_down").removeClass("fa fa-angle-down fa-2x");
            $("#menu_arrow_down").addClass("fa fa-angle-up fa-2x");
            $("#menu_arrow_down").attr( "value", "1" );
        }
        else 
        {
            $("#menu_arrow_down").removeClass("fa fa-angle-up fa-2x");
            $("#menu_arrow_down").addClass("fa fa-angle-down fa-2x");
            $("#menu_arrow_down").attr( "value", "0" );
        }
    });
    // slider 

    $("#slideshow > .img_slider:gt(0)").hide();
    
    setInterval(function() {
        $('#slideshow > .img_slider:first')
            .fadeOut(1000)
            .next()
            .fadeIn(1000)
            .end()
            .appendTo('#slideshow');
    }, 3000);

    $("#slideshow-mobile > .img_slider:gt(0)").hide();

    setInterval(function() {
        $('#slideshow-mobile > .img_slider:first')
            .fadeOut(1000)
            .next()
            .fadeIn(1000)
            .end()
            .appendTo('#slideshow-mobile');
    }, 3000);

    // highlight

    $('.multi-item-carousel').carousel({
        interval: false
    });
    
    $('.multi-item-carousel .item').each(function(){
        var next = $(this).next();
        if (!next.length) {
        next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
        
        if (next.next().length>0) {
        next.next().children(':first-child').clone().appendTo($(this));
        } else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });

    // scroll down 

    $('.scroll-down-media').click (function() {
        $('html, body').animate({scrollTop: $('#media').offset().top }, 'slow');
        return false;
    });

    $('.scroll-down-footer').click (function() {
        $('html, body').animate({scrollTop: $('#footer').offset().top }, 'slow');
        return false;
    });

    // subcribe

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $(".btn_subcribe").click(function(){
        var input = $("#input_subcribe").val();
        if( input != "" )
        {
            if( validateEmail(input) )
            {
                alert("Bạn sẽ nhận được thông báo thông tin mới. Cảm ơn!");
            }
            else 
            {
                alert("Bạn phải nhập đúng email");
            }
            
        }
        else {
            alert("Hãy nhập địa chỉ email của bạn !");
        }
        
    });



});