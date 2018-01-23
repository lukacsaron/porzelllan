(function($) {
    "use strict";

    window.eltd = {};
    eltd.modules = {};

    eltd.scroll = 0;
    eltd.window = $(window);
    eltd.document = $(document);
    eltd.windowWidth = $(window).width();
    eltd.windowHeight = $(window).height();
    eltd.body = $('body');
    eltd.html = $('html, body');
    eltd.htmlEl = $('html');
    eltd.menuDropdownHeightSet = false;
    eltd.defaultHeaderStyle = '';
    eltd.minVideoWidth = 1500;
    eltd.videoWidthOriginal = 1280;
    eltd.videoHeightOriginal = 720;
    eltd.videoRatio = 1280/720;

    //set boxed layout width variable for various calculations

    switch(true){
        case eltd.body.hasClass('eltd-grid-1300'):
            eltd.boxedLayoutWidth = 1350;
            break;
        case eltd.body.hasClass('eltd-grid-1200'):
            eltd.boxedLayoutWidth = 1250;
            break;
        case eltd.body.hasClass('eltd-grid-1000'):
            eltd.boxedLayoutWidth = 1050;
            break;
        case eltd.body.hasClass('eltd-grid-800'):
            eltd.boxedLayoutWidth = 850;
            break;
        default :
            eltd.boxedLayoutWidth = 1150;
            break;
    }
    
    $(document).ready(function(){
        eltd.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(eltd.body.hasClass('eltd-dark-header')){ eltd.defaultHeaderStyle = 'eltd-dark-header';}
        if(eltd.body.hasClass('eltd-light-header')){ eltd.defaultHeaderStyle = 'eltd-light-header';}

    });


    $(window).resize(function() {
        eltd.windowWidth = $(window).width();
        eltd.windowHeight = $(window).height();
    });


    $(window).scroll(function(){
        eltd.scroll = $(window).scrollTop();
    });



})(jQuery);