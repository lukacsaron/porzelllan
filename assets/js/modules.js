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
(function($) {
	"use strict";

    var common = {};
    eltd.modules.common = common;

    common.eltdFluidVideo = eltdFluidVideo;
    common.eltdPreloadBackgrounds = eltdPreloadBackgrounds;
    common.eltdPrettyPhoto = eltdPrettyPhoto;
    common.eltdCheckHeaderStyleOnScroll = eltdCheckHeaderStyleOnScroll;
    common.eltdInitParallax = eltdInitParallax;
    common.eltdSmoothScroll = eltdSmoothScroll;
    common.eltdEnableScroll = eltdEnableScroll;
    common.eltdDisableScroll = eltdDisableScroll;
    common.eltdWheel = eltdWheel;
    common.eltdKeydown = eltdKeydown;
    common.eltdPreventDefaultValue = eltdPreventDefaultValue;
    common.eltdOwlSlider = eltdOwlSlider;
    common.eltdInitSelfHostedVideoPlayer = eltdInitSelfHostedVideoPlayer;
    common.eltdSelfHostedVideoSize = eltdSelfHostedVideoSize;
    common.eltdInitBackToTop = eltdInitBackToTop;
    common.eltdBackButtonShowHide = eltdBackButtonShowHide;
    common.eltd404PageHeight = eltd404PageHeight;
    common.eltdSmoothTransition = eltdSmoothTransition;
    common.eltdSingleImageAnimation = eltdSingleImageAnimation;
    
	$(document).ready(function() {
        eltd404PageHeight();
		eltdFluidVideo();
        eltdPreloadBackgrounds();
        eltdPrettyPhoto();
        eltdInitElementsAnimations();
        eltdInitAnchor().init();
        eltdInitVideoBackground();
        eltdInitVideoBackgroundSize();
        eltdSetContentBottomMargin();
        eltdSmoothScroll();
        eltdOwlSlider();
        eltdInitSelfHostedVideoPlayer();
		eltdSelfHostedVideoSize();
        eltdInitBackToTop();
        eltdBackButtonShowHide();
        eltdSmoothTransition();
	});

    $(window).load(function() {
        eltdCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right        
        eltdSingleImageAnimation();
    });

	$(window).resize(function() {
		eltdInitVideoBackgroundSize();
		eltdSelfHostedVideoSize();
	});

	function eltdFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    /**
     * Init Owl Carousel
     */
    function eltdOwlSlider() {

        var sliders = $('.eltd-owl-slider');

        if (sliders.length) {
            sliders.each(function(){

                var slider = $(this);
                slider.owlCarousel({
                    singleItem: true,
                    transitionStyle: 'fadeUp',
                    navigation: true,
                    autoHeight: true,
                    pagination: false,
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="eltd-icon-linea-icon icon-arrows-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="eltd-icon-linea-icon icon-arrows-right"></i></span>'               
                    ]
                });

            });
        }

    }


    /*
     *	Preload background images for elements that have 'eltd-preload-background' class
     */
    function eltdPreloadBackgrounds(){

        $(".eltd-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('eltd-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('eltd-preload-background'); }); //make sure that eltd-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function eltdPrettyPhoto() {
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><i class="eltd-icon-linea-icon icon-arrows-right"></i></a> \
                                            <a class="pp_previous" href="#"><i class="eltd-icon-linea-icon icon-arrows-left"></i></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    /*
     *	Check header style on scroll, depending on row settings
     */
    function eltdCheckHeaderStyleOnScroll(){

        if($('[data-eltd_header_style]').length > 0 && eltd.body.hasClass('eltd-header-style-on-scroll')) {

            var waypointSelectors = $('.eltd-full-width-inner > .wpb_row.eltd-section, .eltd-full-width-inner > .eltd-parallax-section-holder, .eltd-container-inner > .wpb_row.eltd-section, .eltd-container-inner > .eltd-parallax-section-holder, .eltd-portfolio-single > .wpb_row.eltd-section');
            var changeStyle = function(element){
                (element.data("eltd_header_style") !== undefined) ? eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(element.data("eltd_header_style")) : eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(''+eltd.defaultHeaderStyle);
            };

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'down') { changeStyle($(this.element)); }
            }, { offset: 0});

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'up') { changeStyle($(this.element)); }
            }, { offset: function(){
                return -$(this.element).outerHeight();
            } });
        }
    }

    /*
     *	Start animations on elements
     */
    function eltdInitElementsAnimations(){

        var touchClass = $('.eltd-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.eltd-grow-in, .eltd-fade-in-down, .eltd-element-from-fade, .eltd-element-from-left, .eltd-element-from-right, .eltd-element-from-top, .eltd-element-from-bottom, .eltd-flip-in, .eltd-x-rotate, .eltd-z-rotate, .eltd-y-translate, .eltd-fade-in, .eltd-fade-in-left-x-rotate'),
            clasess,
            animationClass;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
                var element = $(this);

                clasess = element.attr('class').split(/\s+/);
                animationClass = clasess[1];

                element.appear(function() {
                    element.addClass(animationClass+'-on');
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }

    }


/*
 **	Sections with parallax background image
 */
function eltdInitParallax(){

    if($('.eltd-parallax-section-holder').length){
        $('.eltd-parallax-section-holder').each(function() {

            var parallaxElement = $(this);
            if(parallaxElement.hasClass('eltd-full-screen-height-parallax')){
                parallaxElement.height(eltd.windowHeight);
                parallaxElement.find('.eltd-parallax-content-outer').css('padding',0);
            }
            var speed = parallaxElement.data('eltd-parallax-speed')*0.4;
            parallaxElement.parallax("50%", speed);
        });
    }
}

/*
 **	Anchor functionality
 */
var eltdInitAnchor = eltd.modules.common.eltdInitAnchor = function() {

    /**
     * Set active state on clicked anchor
     * @param anchor, clicked anchor
     */
    var setActiveState = function(anchor){

        $('.eltd-main-menu .eltd-active-item, .eltd-mobile-nav .eltd-active-item, .eltd-vertical-menu .eltd-active-item, .eltd-fullscreen-menu .eltd-active-item').removeClass('eltd-active-item');
        anchor.parent().addClass('eltd-active-item');

        $('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-vertical-menu a, .eltd-fullscreen-menu a').removeClass('current');
        anchor.addClass('current');
    };

    /**
     * Check anchor active state on scroll
     */
    var checkActiveStateOnScroll = function(){

        $('[data-eltd-anchor]').waypoint( function(direction) {
            if(direction === 'down') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltd-anchor")+"']"));
            }
        }, { offset: '50%' });

        $('[data-eltd-anchor]').waypoint( function(direction) {
            if(direction === 'up') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("eltd-anchor")+"']"));
            }
        }, { offset: function(){
            return -($(this.element).outerHeight() - 150);
        } });

    };

    /**
     * Check anchor active state on load
     */
    var checkActiveStateOnLoad = function(){
        var hash = window.location.hash.split('#')[1];

        if(hash !== "" && $('[data-eltd-anchor="'+hash+'"]').length > 0){
            //triggers click which is handled in 'anchorClick' function
            $("a[href='"+window.location.href.split('#')[0]+"#"+hash+"'").trigger( "click" );
        }
    };

    /**
     * Calculate header height to be substract from scroll amount
     * @param anchoredElementOffset, anchorded element offest
     */
    var headerHeihtToSubtract = function(anchoredElementOffset){

        if(eltd.modules.header.behaviour == 'eltd-sticky-header-on-scroll-down-up') {
            (anchoredElementOffset > eltd.modules.header.stickyAppearAmount) ? eltd.modules.header.isStickyVisible = true : eltd.modules.header.isStickyVisible = false;
        }

        if(eltd.modules.header.behaviour == 'eltd-sticky-header-on-scroll-up') {
            (anchoredElementOffset > eltd.scroll) ? eltd.modules.header.isStickyVisible = false : '';
        }

        var headerHeight = eltd.modules.header.isStickyVisible ? eltdGlobalVars.vars.eltdStickyHeaderTransparencyHeight : eltdPerPageVars.vars.eltdHeaderTransparencyHeight;

        return headerHeight;
    };

    /**
     * Handle anchor click
     */
    var anchorClick = function() {
        eltd.document.on("click", ".eltd-main-menu a, .eltd-vertical-menu a, .eltd-fullscreen-menu a, .eltd-btn, .eltd-anchor", function() {
            var scrollAmount;
            var anchor = $(this);
            var hash = anchor.prop("hash").split('#')[1];

            if(hash !== "" && $('[data-eltd-anchor="' + hash + '"]').length > 0 && anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]) {

                var anchoredElementOffset = $('[data-eltd-anchor="' + hash + '"]').offset().top;
                scrollAmount = $('[data-eltd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                setActiveState(anchor);

                eltd.html.stop().animate({
                    scrollTop: Math.round(scrollAmount)
                }, 1000, function() {
                    //change hash tag in url
                    if(history.pushState) { history.pushState(null, null, '#'+hash); }
                });
                return false;
            }
        });
    };

    return {
        init: function() {
            if($('[data-eltd-anchor]').length) {
                anchorClick();
                checkActiveStateOnScroll();
                $(window).load(function() { checkActiveStateOnLoad(); });
            }
        }
    };

};

/*
 **	Video background initialization
 */
function eltdInitVideoBackground(){

    $('.eltd-section .eltd-video-wrap .eltd-video').mediaelementplayer({
        enableKeyboard: false,
        iPadUseNativeControls: false,
        pauseOtherPlayers: false,
        // force iPhone's native controls
        iPhoneUseNativeControls: false,
        // force Android's native controls
        AndroidUseNativeControls: false
    });

    //mobile check
    if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
        eltdInitVideoBackgroundSize();
        $('.eltd-section .eltd-mobile-video-image').show();
        $('.eltd-section .eltd-video-wrap').remove();
    }
}

    /*
     **	Calculate video background size
     */
    function eltdInitVideoBackgroundSize(){

        $('.eltd-section .eltd-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.eltd-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.eltd-section').outerHeight();
            eltd.minVideoWidth = eltd.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / eltd.videoWidthOriginal;
            var scaleV = sectionHeight / eltd.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * eltd.videoWidthOriginal < eltd.minVideoWidth) {scale = eltd.minVideoWidth / eltd.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * eltd.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * eltd.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function eltdSetContentBottomMargin(){
        var uncoverFooter = $('.eltd-footer-uncover');

        if(uncoverFooter.length){
            $('.eltd-content').css('margin-bottom', $('.eltd-footer-inner').height());
        }
    }

	/*
	** Initiate Smooth Scroll
	*/

    // this function needs to be out because all three functions below use it
    var smoothScrollListener = function(event){
        event.preventDefault();

        var scrollTime = 0.6;           //Scroll time
        var scrollDistance = 300;       //Distance. Use smaller value for shorter scroll and greater value for longer scroll

        var delta = event.wheelDelta / 120 || -event.detail / 3; //default coeffs - 120, 3
        var scrollTop = eltd.window.scrollTop();
        var finalScroll = scrollTop - parseInt(delta * scrollDistance);

        TweenLite.to(eltd.window, scrollTime, {
            scrollTo: {
                y: finalScroll, autoKill: !0
            },
            ease: Power1.easeOut,
            autoKill: !0,
            overwrite: 5
        });
    };

	function eltdSmoothScroll(){

		if(eltd.body.hasClass('eltd-smooth-scroll')){

			var mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");

			if (!$('html').hasClass('touch') && !mobile_ie) {
				if (window.addEventListener) {
					window.addEventListener('mousewheel', smoothScrollListener, false);
					window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
				}
			}
		}
	}

    function eltdDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', eltdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = eltdWheel;
        document.onkeydown = eltdKeydown;

        if(eltd.body.hasClass('eltd-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function eltdEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', eltdWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(eltd.body.hasClass('eltd-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function eltdWheel(e) {
        eltdPreventDefaultValue(e);
    }

    function eltdKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                eltdPreventDefaultValue(e);
                return;
            }
        }
    }

    function eltdPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function eltdInitSelfHostedVideoPlayer() {

        var players = $('.eltd-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function eltdSelfHostedVideoSize(){

		$('.eltd-self-hosted-video-holder .eltd-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.eltd-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / eltd.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}

    function eltdToTopButton(a) {
        
        var b = $("#eltd-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function eltdBackButtonShowHide(){
        eltd.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { eltdToTopButton('off'); } else { eltdToTopButton('on'); }
        });
    }

    function eltdInitBackToTop(){
        var backToTopButton = $('#eltd-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            eltd.html.animate({scrollTop: 0}, eltd.window.scrollTop()/3, 'linear');
        });
    }

    function eltd404PageHeight() {
        var page404 = $('body.error404'),
            height;

        if (page404) {
            height = eltd.window.height();
            page404.find('.eltd-content').css({
                'height' : height
            });
        }

    }

    function eltdSmoothTransition() {
        var loader = $('body > .eltd-smooth-transition-loader');
        if (loader.length) {
            loader.fadeOut(300);
            $(window).focus(function() {
                loader.fadeOut(300);
            });

            $('a').click(function(e) {
                var a = $(this);
                if (
                    e.which == 1 && // check if the left mouse button has been pressed
                    (typeof a.data('rel') === 'undefined') && //Not pretty photo link
                    a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                    (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                ) {
                    e.preventDefault();
                    loader.addClass('eltd-hide-spinner');
                    loader.fadeIn(500, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }
    
    // visual composer single image(animation start offset) override
    
    function eltdSingleImageAnimation(){

        var container = $('.wpb_single_image.wpb_animate_when_almost_visible');
        var animateOnTouch = $('.eltd-no-animations-on-touch');
        var appearCoeff = eltd.windowHeight/5;
        
        if(container.length && !animateOnTouch.length){
            container.each(function(){
                var thisImage = $(this);
                    thisImage.appear(function() {
                        thisImage.addClass('wpb_start_animation');                       
                    },{accX: 0, accY: -appearCoeff});
            });
        }
    }

})(jQuery);



(function($) {
    "use strict";

    var header = {};
    eltd.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.eltdSideArea = eltdSideArea;
    header.eltdSideAreaScroll = eltdSideAreaScroll;
    header.eltdFullscreenMenu = eltdFullscreenMenu;
    header.eltdInitMobileNavigation = eltdInitMobileNavigation;
    header.eltdMobileHeaderBehavior = eltdMobileHeaderBehavior;
    header.eltdSetDropDownMenuPosition = eltdSetDropDownMenuPosition;
    header.eltdDropDownMenu = eltdDropDownMenu;
    header.eltdSearch = eltdSearch;
    header.eltdAnimateHeaderContents = eltdAnimateHeaderContents;

    $(document).ready(function() {
        eltdHeaderBehaviour();
        eltdSideArea();
        eltdSideAreaScroll();
        eltdFullscreenMenu();
        eltdInitMobileNavigation();
        eltdMobileHeaderBehavior();
        eltdSetDropDownMenuPosition();
        eltdDropDownMenu();
        eltdSearch();
        eltdAnimateHeaderContents();
    });

    $(window).load(function() {
        eltdSetDropDownMenuPosition();        
    });

    $(window).resize(function() {
        eltdDropDownMenu();
        eltdAdjHeaderContentsAppearance();
    });

    /*
     **	Show/Hide sticky header on window scroll
     */
    function eltdHeaderBehaviour() {

        var header = $('.eltd-page-header');
        var stickyHeader = $('.eltd-sticky-header');
        var fixedHeaderWrapper = $('.eltd-fixed-wrapper');

        var headerMenuAreaOffset = $('.eltd-page-header').find('.eltd-fixed-wrapper').length ? $('.eltd-page-header').find('.eltd-fixed-wrapper').offset().top : null;

        var stickyAppearAmount;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-up'):
                eltd.modules.header.behaviour = 'eltd-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight + eltdGlobalVars.vars.eltdStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        eltd.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                    }else {
                        eltd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-down-up'):
                eltd.modules.header.behaviour = 'eltd-sticky-header-on-scroll-down-up';
                stickyAppearAmount = eltdPerPageVars.vars.eltdStickyScrollAmount !== 0 ? eltdPerPageVars.vars.eltdStickyScrollAmount : eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight;
                eltd.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic
                
                var headerAppear = function(){
                    if(eltd.scroll < stickyAppearAmount) {
                        eltd.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                    }else{
                        eltd.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case eltd.body.hasClass('eltd-fixed-on-scroll'):
                eltd.modules.header.behaviour = 'eltd-fixed-on-scroll';
                var headerFixed = function(){
                    if(eltd.scroll < headerMenuAreaOffset){
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom',0);}
                    else{
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function eltdSideArea() {

        var wrapper = $('.eltd-wrapper'),
            sideMenu = $('.eltd-side-menu'),
            sideMenuButtonOpen = $('a.eltd-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (eltd.body.hasClass('eltd-side-menu-slide-from-right')) {

            cssClass = 'eltd-right-side-menu-opened';
            wrapper.prepend('<div class="eltd-cover"/>');
            slideFromRight = true;

        } else if (eltd.body.hasClass('eltd-side-menu-slide-with-content')) {

            cssClass = 'eltd-side-menu-open';
            slideWithContent = true;

        } else if (eltd.body.hasClass('eltd-side-area-uncovered-from-content')) {

            cssClass = 'eltd-right-side-menu-opened';
            slideUncovered = true;

        }

        $('a.eltd-side-menu-button-opener, a.eltd-close-side-menu').click( function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                eltd.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.eltd-wrapper .eltd-cover').click(function() {
                        eltd.body.removeClass('eltd-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(eltd.scroll - currentScroll) > 400){
                        eltd.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                eltd.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }

            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.click(function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    eltd.body.removeClass('eltd-side-menu-open');
                });

            }

        });

    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function eltdSideAreaScroll(){


    }

    /**
     * Init Fullscreen Menu
     */
    function eltdFullscreenMenu() {

      



    }

    function eltdInitMobileNavigation() {
        var navigationOpener = $('.eltd-mobile-header .eltd-mobile-menu-opener');
        var navigationHolder = $('.eltd-mobile-header .eltd-mobile-nav');
        var dropdownOpener = $('.eltd-mobile-nav .mobile_arrow, .eltd-mobile-nav h4, .eltd-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var dropdownToOpen = $(this).nextAll('ul').first();
                    var openerParent = $(this).parent('li');
                    if(dropdownToOpen.is(':visible')) {
                        dropdownToOpen.slideUp(animationSpeed);
                        openerParent.removeClass('eltd-opened');
                    } else {
                        dropdownToOpen.slideDown(animationSpeed);
                        openerParent.addClass('eltd-opened');
                    }
                });
            });
        }

        $('.eltd-mobile-nav a, .eltd-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function eltdMobileHeaderBehavior() {
        if(eltd.body.hasClass('eltd-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.eltd-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('eltd-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('eltd-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.eltd-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);

                    //if(adminBar.length) {
                    //    mobileHeader.find('.eltd-mobile-header-inner').css('top', adminBarHeight);
                    //}
                }

                docYScroll1 = $(document).scrollTop();
            });
        }

    }


    /**
     * Set dropdown position
     */
    function eltdSetDropDownMenuPosition(){

        var menuItems = $(".eltd-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = eltd.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(eltd.body.hasClass('boxed')){
                menuItemFromLeft = eltd.boxedLayoutWidth  - (menuItemPosition - (browserWidth - eltd.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });

    }


    function eltdDropDownMenu() {

        var menu_items = $('.eltd-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });
                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if(!$(this).hasClass('wide_background')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = (eltd.windowWidth - 2 * (eltd.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', eltd.windowWidth);

                        }
                    }
                }

                if(!eltd.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(eltd.body.hasClass('eltd-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 200, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 0, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('eltd-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('eltd-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
        $('.eltd-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which == 1){
				var $this = $j(this);
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
        });

        eltd.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function eltdSearch() {

        var searchOpener = $('a.eltd-search-opener'),
            searchClose,
            searchForm,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( eltd.body.hasClass( 'eltd-fullscreen-search' ) ) {

                var fullscreenSearchFade = false,
                    fullscreenSearchFromCircle = false;

                searchClose = $( '.eltd-fullscreen-search-close' );

                if (eltd.body.hasClass('eltd-search-fade')) {
                    fullscreenSearchFade = true;
                } else if (eltd.body.hasClass('eltd-search-from-circle')) {
                    fullscreenSearchFromCircle = true;
                }
                eltdFullscreenSearch( fullscreenSearchFade, fullscreenSearchFromCircle );

            } else if ( eltd.body.hasClass( 'eltd-search-slides-from-window-top' ) ) {

                searchForm = $('.eltd-search-slide-window-top');
                searchClose = $('.eltd-search-close');
                eltdSearchWindowTop();

            } else if ( eltd.body.hasClass( 'eltd-search-slides-from-header-bottom' ) ) {

                eltdSearchHeaderBottom();

            } else if ( eltd.body.hasClass( 'eltd-search-covers-header' ) ) {

                eltdSearchCoversHeader();

            } else if ( eltd.body.hasClass( 'eltd-search-dropdown' ) ) {

                eltdSearchDropdown();

            }

        }

        /**
         * Search slides from window top type of search
         */
        function eltdSearchWindowTop() {

            searchOpener.click( function(e) {
                e.preventDefault();

                if($('.title').hasClass('has_parallax_background')){
                    var yPos = parseInt($('.title.has_parallax_background').css('backgroundPosition').split(" ")[1]);
                }else {
                    var yPos = 0;
                }
                if ( searchForm.height() == "0") {
                    $('.eltd-search-slide-window-top input[type="text"]').focus();
                    //Push header bottom
                    eltd.body.addClass('eltd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos + 50)+'px'
                    }, 150);
                } else {
                    eltd.body.removeClass('eltd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos - 50)+'px'
                    }, 150);
                }

                $(window).scroll(function() {
                    if ( searchForm.height() != '0' && eltd.scroll > 50 ) {
                        eltd.body.removeClass('eltd-search-open');
                        $('.title.has_parallax_background').css('backgroundPosition', 'center '+(yPos)+'px');
                    }
                });

                searchClose.click(function(e){
                    e.preventDefault();
                    eltd.body.removeClass('eltd-search-open');
                    $('.title.has_parallax_background').animate({
                        'background-position-y': (yPos)+'px'
                    }, 150);
                });

            });
        }

        /**
         * Search slides from header bottom type of search
         */
        function eltdSearchHeaderBottom() {

            var searchInput = $('.eltd-search-slide-header-bottom input[type="submit"]');

            searchOpener.click( function(e) {
                e.preventDefault();

                //If there is form openers in multiple widgets, only one search form should be opened
                if ( $(this).closest('.eltd-mobile-header').length > 0 ) {
                    //    Open form in mobile header
                    searchForm = $(this).closest('.eltd-mobile-header').children().children().first();
                } else if ( $(this).closest('.eltd-sticky-header').length > 0 ) {
                    //    Open form in sticky header
                    searchForm= $(this).closest('.eltd-sticky-header').children().first();
                } else {
                    //Open first form in header
                    searchForm = $('.eltd-search-slide-header-bottom').first();
                }

                if( searchForm.hasClass( 'eltd-animated' ) ) {
                    searchForm.removeClass('eltd-animated');
                } else {
                    searchForm.addClass('eltd-animated');
                }

                searchForm.addClass('eltd-disabled');
                searchInput.attr('disabled','eltd-disabled');
                if( ( $('.eltd-search-slide-header-bottom .eltd-search-field').val() !== '' ) && ( $('.eltd-search-slide-header-bottom .eltd-search-field').val() !== ' ' ) ) {
                    searchInput.removeAttr('eltd-disabled');
                    searchForm.removeClass('eltd-disabled');
                } else {
                    searchForm.addClass('eltd-disabled');
                    searchInput.attr('disabled','eltd-disabled');
                }

                $('.eltd-search-slide-header-bottom .eltd-search-field').keyup(function() {
                    if( ($(this).val() !== '' ) && ( $(this).val() != ' ') ) {
                        searchInput.removeAttr('eltd-disabled');
                        searchForm.removeClass('eltd-disabled');
                    }
                    else {
                        searchInput.attr('disabled','eltd-disabled');
                        searchForm.addClass('eltd-disabled');
                    }
                });

                $('.content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.removeClass('eltd-animated');
                });

            });

            //Submit form
            if($('.eltd-search-submit').length) {
                $('.eltd-search-submit').click(function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    searchForm.submit();
                });
            }
        }

        /**
         * Search covers header type of search
         */
        function eltdSearchCoversHeader() {

            searchOpener.click( function(e) {
                e.preventDefault();
                var searchFormHeight,
                    searchFormHolder = $('.eltd-search-cover .eltd-form-holder-outer'),
                    searchForm,
                    searchFormLandmark; // there is one more div element if header is in grid

                if($(this).closest('.eltd-grid').length){
                    searchForm = $(this).closest('.eltd-grid').children().first();
                    searchFormLandmark = searchForm.parent();
                }
                else{
                    searchForm = $(this).closest('.eltd-menu-area').children().first();
                    searchFormLandmark = searchForm;
                }

                if ( $(this).closest('.eltd-sticky-header').length > 0 ) {
                    searchForm = $(this).closest('.eltd-sticky-header').children().first();
                }
                if ( $(this).closest('.eltd-mobile-header').length > 0 ) {
                    searchForm = $(this).closest('.eltd-mobile-header').children().children().first();
                }

                //Find search form position in header and height
                if ( searchFormLandmark.parent().hasClass('eltd-logo-area') ) {
                    searchFormHeight = eltdGlobalVars.vars.eltdLogoAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('eltd-top-bar') ) {
                    searchFormHeight = eltdGlobalVars.vars.eltdTopBarHeight;
                } else if ( searchFormLandmark.parent().hasClass('eltd-menu-area') ) {
                    searchFormHeight = eltdGlobalVars.vars.eltdMenuAreaHeight;
                } else if ( searchFormLandmark.hasClass('eltd-sticky-header') ) {
                    searchFormHeight = eltdGlobalVars.vars.eltdMenuAreaHeight;
                } else if ( searchFormLandmark.parent().hasClass('eltd-mobile-header') ) {
                    searchFormHeight = $('.eltd-mobile-header-inner').height();
                }

                searchFormHolder.height(searchFormHeight);
                searchForm.stop(true).fadeIn(600);
                $('.eltd-search-cover input[type="text"]').focus();
                $('.eltd-search-close, .content, footer').click(function(e){
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });
                searchForm.blur(function() {
                    searchForm.stop(true).fadeOut(450);
                });
            });

        }

        function eltdSearchDropdown() {

            var searchHolder;

            searchOpener.click(function(){

                var searchHolderSibling = $(this).closest('.eltd-vertical-align-containers').parent(),
                    rightPos = $(window).width() - $(this).offset().left - $(this).outerWidth();

                if (searchHolderSibling.hasClass('eltd-menu-area')) {
                    searchHolder = searchHolderSibling.siblings('.eltd-search-dropdown-holder');
                } else if (searchHolderSibling.hasClass('eltd-sticky-holder')) {
                    searchHolder = searchHolderSibling.children('.eltd-search-dropdown-holder');
                }

                searchHolder.css({
                    'right' : rightPos
                });

                if (searchHolder.is(':visible')) {
                    searchHolder.fadeOut(300);
                } else {
                    searchHolder.fadeIn(300);
                }

                var stickyAppearAmount = eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight + eltdGlobalVars.vars.eltdStickyHeaderHeight;
                $(window).scroll(function(){
                    if (searchHolder.is(':visible') && $(window).scrollTop() < stickyAppearAmount ) {
                        searchHolder.fadeOut(300);
                    }
                });

            });

        }

        /**
         * Fullscreen search (two types: fade and from circle)
         */
        function eltdFullscreenSearch( fade, fromCircle ) {

            var searchHolder = $( '.eltd-fullscreen-search-holder'),
                searchOverlay = $( '.eltd-fullscreen-search-overlay' );

            searchOpener.click( function(e) {
                e.preventDefault();
                var samePosition = false;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    var closeTop = $(this).offset().top;
                    var closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if ( fade ) {
                    if ( searchHolder.hasClass( 'eltd-animate' ) ) {
                        eltd.body.removeClass('eltd-fullscreen-search-opened');
                        eltd.body.addClass( 'eltd-search-fade-out' );
                        eltd.body.removeClass( 'eltd-search-fade-in' );
                        searchHolder.removeClass( 'eltd-animate' );
                        if(!eltd.body.hasClass('page-template-full_screen-php')){
                            eltd.modules.common.eltdEnableScroll();
                        }
                    } else {
                        eltd.body.addClass('eltd-fullscreen-search-opened');
                        eltd.body.removeClass('eltd-search-fade-out');
                        eltd.body.addClass('eltd-search-fade-in');
                        searchHolder.addClass('eltd-animate');
                        if (samePosition) {
                            searchClose.css({
                                'top' : closeTop - eltd.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                'left' : closeLeft
                            });
                        }
                        if(!eltd.body.hasClass('page-template-full_screen-php')){
                            eltd.modules.common.eltdDisableScroll();
                        }
                    }
                    searchClose.click( function(e) {
                        e.preventDefault();
                        eltd.body.removeClass('eltd-fullscreen-search-opened');
                        searchHolder.removeClass('eltd-animate');
                        eltd.body.removeClass('eltd-search-fade-in');
                        eltd.body.addClass('eltd-search-fade-out');
                        if(!eltd.body.hasClass('page-template-full_screen-php')){
                            eltd.modules.common.eltdEnableScroll();
                        }
                    });
                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            eltd.body.removeClass('eltd-fullscreen-search-opened');
                            searchHolder.removeClass('eltd-animate');
                            eltd.body.removeClass('eltd-search-fade-in');
                            eltd.body.addClass('eltd-search-fade-out');
                            if(!eltd.body.hasClass('page-template-full_screen-php')){
                                eltd.modules.common.eltdEnableScroll();
                            }
                        }
                    });
                }
                //Fullscreen search from circle
                if ( fromCircle ) {
                    if( searchOverlay.hasClass('eltd-animate') ) {
                        searchOverlay.removeClass('eltd-animate');
                        searchHolder.css({
                            'opacity': 0,
                            'display':'none'
                        });
                        searchClose.css({
                            'opacity' : 0,
                            'visibility' : 'hidden'
                        });
                        searchOpener.css({
                            'opacity': 1
                        });
                    } else {
                        searchOverlay.addClass('eltd-animate');
                        searchHolder.css({
                            'display':'block'
                        });
                        setTimeout(function(){
                            searchHolder.css('opacity','1');
                            searchClose.css({
                                'opacity' : 1,
                                'visibility' : 'visible',
                                'top' : closeTop - eltd.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                'left' : closeLeft
                            });
                            if (samePosition) {
                                searchClose.css({
                                    'top' : closeTop - eltd.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                                    'left' : closeLeft
                                });
                            }
                            searchOpener.css({
                                'opacity' : 0
                            });
                        },200);
                        if(!eltd.body.hasClass('page-template-full_screen-php')){
                            eltd.modules.common.eltdDisableScroll();
                        }
                    }
                    searchClose.click(function(e) {
                        e.preventDefault();
                        searchOverlay.removeClass('eltd-animate');
                        searchHolder.css({
                            'opacity' : 0,
                            'display' : 'none'
                        });
                        searchClose.css({
                            'opacity':0,
                            'visibility' : 'hidden'
                        });
                        searchOpener.css({
                            'opacity' : 1
                        });
                        if(!eltd.body.hasClass('page-template-full_screen-php')){
                            eltd.modules.common.eltdEnableScroll();
                        }
                    });
                    //Close on escape
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                            searchOverlay.removeClass('eltd-animate');
                            searchHolder.css({
                                'opacity' : 0,
                                'display' : 'none'
                            });
                            searchClose.css({
                                'opacity':0,
                                'visibility' : 'hidden'
                            });
                            searchOpener.css({
                                'opacity' : 1
                            });
                            if(!eltd.body.hasClass('page-template-full_screen-php')){
                                eltd.modules.common.eltdEnableScroll();
                            }
                        }
                    });
                }
            });

            //Text input focus change
            $('.eltd-fullscreen-search-holder .eltd-search-field').focus(function(){
                $('.eltd-fullscreen-search-holder .eltd-field-holder .eltd-line').css("width","100%");
            });

            $('.eltd-fullscreen-search-holder .eltd-search-field').blur(function(){
                $('.eltd-fullscreen-search-holder .eltd-field-holder .eltd-line').css("width","0");
            });

        }

    }

    /**
    *   Animate header contents init
    */

    function eltdAnimateHeaderContents() {

        //vars elements
        var header = $('.eltd-page-header');
        var stickyHeader = $('.eltd-sticky-holder');
        var logo = header.find('.eltd-logo-wrapper');
        var menuItem = header.find('.eltd-main-menu > ul > Li');
        var menuItemsNumber = menuItem.length;
            //if sticky menu is set divide menu items number by two
            if(stickyHeader.length){
                menuItemsNumber = menuItemsNumber/2;
            }
        var widget = header.find('.eltd-header-right-sidebar-inner > div');
        var widgetsNumber = widget.length;

        //var animation params
        var logoAnimationOffset = 200; //logo start offset
        var logoAnimationDuration = 2000;
        var menuAnimationOffset = 500; //menu start offset
        var menuItemAnimationDuration = 1200; 
        var menuItemAnimationOffset = 150; // time between two menu items are animated
        var widgetsAnimationOffset = menuAnimationOffset + menuItemAnimationDuration;
        var widgetItemAnimationDuration = 1200;
        var widgetItemAnimationOffset = 300; // time between two widgets are animated
        var headerContentsAnimationEnd = widgetsAnimationOffset + widgetItemAnimationDuration;
        var headerContentsAnimationEndOffset = logoAnimationOffset + 600; //speed up the ending when the header class gets added to trigger other DOM elements


        //desktop devices - animate header elements one by one
        if (header.length && ($('html').hasClass('no-touch'))){

            //logo appears
            logo.css({opacity:0});
            logo.delay(logoAnimationOffset).animate({opacity:1}, logoAnimationDuration, 'easeOutSine');

            //menu items appear
            setTimeout(function(){
                menuItem.each(function(i){
                    $(this).delay(i*menuItemAnimationOffset).animate({opacity:1},menuItemAnimationDuration);
                });
            },menuAnimationOffset);

            //widgets appear
            setTimeout(function(){
                widget.each(function(i){
                    $(this).delay(i*widgetItemAnimationOffset).animate({opacity:1},widgetItemAnimationDuration);
                });
            },widgetsAnimationOffset);

            //add header class when all elements have appeared
            setTimeout(function(){
                $('body').addClass('eltd-header-contents-loaded');
                eltd.modules.title.eltdTitleAnimation();
            },  headerContentsAnimationEnd - headerContentsAnimationEndOffset);

        }

        //mobile devices - no header animation
        if (header.length && ($('html').hasClass('touch'))){ 
            $('body').addClass('eltd-header-contents-loaded');
            eltd.modules.title.eltdTitleAnimation();
        }
    }

    
  /*
  * Fix opacity issues on resize
  */

  function eltdAdjHeaderContentsAppearance() {

        //vars
        var header = $('.eltd-page-header');
        var logo = header.find('.eltd-logo-wrapper');
        var menuItem = header.find('.eltd-main-menu > ul > Li');
        var widget = header.find('.eltd-header-right-sidebar-inner > div');

        if (header.length){
            setTimeout(function(){
                logo.animate({opacity:1},200);
                menuItem.animate({opacity:1},300);
                widget.animate({opacity:1},400);
            }, 200);
        }
  }

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    eltd.modules.title = title;

    title.eltdParallaxTitle = eltdParallaxTitle;
    title.eltdTitleAnimation = eltdTitleAnimation;

    $(document).ready(function() {
        eltdParallaxTitle();
        eltdTitleAnimation();
    });

    $(window).load(function() {


    });

    $(window).resize(function() {

    });

    /*
     **	Title image with parallax effect
     */
    function eltdParallaxTitle(){
        if($('.eltd-title.eltd-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.eltd-title.eltd-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.eltd-title.eltd-has-parallax-background.eltd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(eltd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(eltd.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});
            });

        }
    }

    /*
     ** Animation on load
     */
    function eltdTitleAnimation(){
        if($('.eltd-header-contents-loaded .eltd-title.eltd-animated-title').length > 0){
            var titleArea = $('.eltd-title.eltd-animated-title');

            titleArea.waitForImages({
                waitForAll: true,
                finished: function() {
                    titleArea.addClass('appeared');
                }
            });

        }
    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    eltd.modules.shortcodes = shortcodes;

    shortcodes.eltdInitCounter = eltdInitCounter;
    shortcodes.eltdInitProgressBars = eltdInitProgressBars;
    shortcodes.eltdInitCountdown = eltdInitCountdown;
    shortcodes.eltdInitMessages = eltdInitMessages;
    shortcodes.eltdInitMessageHeight = eltdInitMessageHeight;
    shortcodes.eltdInitTestimonials = eltdInitTestimonials;
    shortcodes.eltdInitCarousels = eltdInitCarousels;
    shortcodes.eltdInitPieChart = eltdInitPieChart;
    shortcodes.eltdInitPieChartDoughnut = eltdInitPieChartDoughnut;
    shortcodes.eltdInitTabs = eltdInitTabs;
    shortcodes.eltdInitBlogListMasonry = eltdInitBlogListMasonry;
    shortcodes.eltdCustomFontResize = eltdCustomFontResize;
    shortcodes.eltdInitImageGallery = eltdInitImageGallery;
    shortcodes.eltdInitAccordions = eltdInitAccordions;
    shortcodes.eltdShowGoogleMap = eltdShowGoogleMap;
    shortcodes.eltdInitPortfolioListMasonry = eltdInitPortfolioListMasonry;
    shortcodes.eltdInitPortfolioListPinterest = eltdInitPortfolioListPinterest;
    shortcodes.eltdInitPortfolio = eltdInitPortfolio;
    shortcodes.eltdInitPortfolioMasonryFilter = eltdInitPortfolioMasonryFilter;
    shortcodes.eltdInitPortfolioSlider = eltdInitPortfolioSlider;
    shortcodes.eltdInitPortfolioLoadMore = eltdInitPortfolioLoadMore;
	shortcodes.eltdInitSectionTitle = eltdInitSectionTitle;
	shortcodes.eltdInitCoverBoxes = eltdInitCoverBoxes;
    shortcodes.eltdCheckSliderForHeaderStyle = eltdCheckSliderForHeaderStyle;
    shortcodes.eltdInitSlideNavigationStyle = eltdInitSlideNavigationStyle;
    shortcodes.eltdInitListAnimation = eltd.eltdInitListAnimation;
    shortcodes.eltdInitTeamAnimation = eltd.eltdInitTeamAnimation;
    shortcodes.eltdInitPricingtableAnimation = eltdInitPricingtableAnimation; 

    $(document).ready(function() {
        eltdInitCounter();
        eltdInitProgressBars();
        eltdInitCountdown();
        eltdIcon().init();
        eltdInitMessages();
        eltdInitMessageHeight();
        eltdInitTestimonials();
        eltdInitPieChart();
        eltdInitPieChartDoughnut();
		eltdInitTabs();
        eltdButton().init();
		eltdCustomFontResize();
        eltdInitImageGallery();
        eltdInitAccordions();
        eltdShowGoogleMap();
        eltdInitPortfolio();
        eltdInitPortfolioMasonryFilter();
        eltdInitPortfolioSlider();
        eltdInitPortfolioLoadMore();
		eltdInitCoverBoxes();
        eltdSlider().init();
        eltdInitListAnimation();
        eltdInitTeamAnimation();
    });

    $(window).load(function(){
        eltdInitCarousels();
        eltdInitPortfolio();
        eltdInitBlogListMasonry();
        eltdInitPortfolioListMasonry();
        eltdInitPortfolioListPinterest();        
        eltdInitSectionTitle();
        eltdInitPricingtableAnimation();
        eltd.modules.common.eltdInitParallax(); //Moved because of properly loading without blank spaces
    });
    
    $(window).resize(function(){
        eltdInitBlogListMasonry();
		eltdCustomFontResize();
        eltdInitPortfolioListMasonry();
        eltdInitPortfolioListPinterest();
		eltdInitSectionTitle();
		eltdInitCoverBoxes();
    });

    /**
     * Counter Shortcode
     */
    function eltdInitCounter() {

        var counters = $('.eltd-counter');


        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parents('.eltd-counter-holder').addClass('eltd-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }

    }
    
        /*
    **	Horizontal progress bars shortcode
    */
    function eltdInitProgressBars(){
        
        var progressBar = $('.eltd-progress-bar');
        
        if(progressBar.length){
            
            progressBar.each(function() {
                
                var thisBar = $(this);
                
                thisBar.appear(function() {
                    eltdInitToCounterProgressBar(thisBar);
                    var percentage = thisBar.find('.eltd-progress-content').data('percentage'),
                        progressContent = thisBar.find('.eltd-progress-content'),
                        progressNumber = thisBar.find('.eltd-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 1500);

                });
            });
        }
    }
    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function eltdInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.eltd-progress-content').data('percentage'));
        var percent = progressBar.find('.eltd-progress-number .eltd-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.eltd-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }
    
    /*
    **	Function to close message shortcode
    */
    function eltdInitMessages(){
        var message = $('.eltd-message');
        if(message.length){
            message.each(function(){
                var thisMessage = $(this);
                thisMessage.find('.eltd-close').click(function(e){
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }
    
    /*
    **	Init message height
    */
   function eltdInitMessageHeight(){
       var message = $('.eltd-message.eltd-with-icon');
       if(message.length){
           message.each(function(){
               var thisMessage = $(this);
               var textHolderHeight = thisMessage.find('.eltd-message-text-holder').height();
               var iconHolderHeight = thisMessage.find('.eltd-message-icon-holder').height();
               
               if(textHolderHeight > iconHolderHeight) {
                   thisMessage.find('.eltd-message-icon-holder').height(textHolderHeight);
               } else {
                   thisMessage.find('.eltd-message-text-holder').height(iconHolderHeight);
               }
           });
       }
   }

    /**
     * Countdown Shortcode
     */
    function eltdInitCountdown() {

        var countdowns = $('.eltd-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize,
                    digitFontColor,
                    labelFontColor;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');
                digitFontColor = countdown.data('digit-color');
                labelFontColor = countdown.data('label-color');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px',
                        'color' : digitFontColor
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px',
                        'color' : labelFontColor
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var eltdIcon = eltd.modules.shortcodes.eltdIcon = function() {
        //get all icons on page
        var icons = $('.eltd-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('eltd-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.eltd-icon-animation-holder').addClass('eltd-icon-animation-show');
                }, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.eltd-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function eltdInitTestimonials(){

        var testimonial = $('.eltd-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                thisTestimonial.appear(function() {
                    thisTestimonial.css('visibility','visible');
                    thisTestimonial.find('.eltd-testimonial-image-holder').addClass('appeared');
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

                var interval = 5000;
                var controlNav = true;
                var directionNav = false;
                var animationSpeed = 600;
                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }

                thisTestimonial.owlCarousel({
                    singleItem: true,
                    //autoPlay: interval,
                    navigation: directionNav,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: controlNav,
                    slideSpeed: animationSpeed,
                    paginationSpeed: animationSpeed,
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function eltdInitCarousels() {

        var carouselHolders = $('.eltd-carousel-holder'),
            carousel,
            numberOfItems,
            navigation;

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                carousel = $(this).children('.eltd-carousel');
                numberOfItems = carousel.data('items');
                navigation = (carousel.data('navigation') == 'yes') ? true : false;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                carousel.waitForImages(function() {
                    carousel.owlCarousel({
                        autoPlay: 3000,
                        items: numberOfItems,
                        itemsCustom: items,
                        pagination: false,
                        navigation: navigation,
                        slideSpeed: 600,
                        navigationText: [
                            '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                            '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                        ]
                    });
                });

            });
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function eltdInitPieChart() {

        var pieCharts = $('.eltd-pie-chart-holder, .eltd-pie-chart-with-icon-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.eltd-percentage, .eltd-percentage-with-icon'),
                    barColor = $(this).children().data('percentage-color') ? $(this).children().data('percentage-color') : '#c9a482',
                    trackColor = $(this).children().data('inactive-color') ? $(this).children().data('inactive-color') : '#f4ede6',
                    lineWidth = 8,
                    size = $(this).children().data('size') ? $(this).children().data('size') : 160;

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.eltd-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /**
     * Init Pie Chart shortcode
     */
    function eltdInitPieChartDoughnut() {

        var pieCharts = $('.eltd-pie-chart-doughnut-holder, .eltd-pie-chart-pie-holder');

        pieCharts.each(function(){

            var pieChart = $(this),
                canvas = pieChart.find('canvas'),
                chartID = canvas.attr('id'),
                chart = document.getElementById(chartID).getContext('2d'),
                data = [],
                jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

            for (var i = 1; i<=10; i++) {

                var chartItem,
                    value = jqChart.data('value-' + i),
                    color = jqChart.data('color-' + i);
                
                if (typeof value !== 'undefined' && typeof color !== 'undefined' ) {
                    chartItem = {
                        value : value,
                        color : color
                    };
                    data.push(chartItem);
                }

            }

            if (canvas.hasClass('eltd-pie')) {
                new Chart(chart).Pie(data,
                    {segmentStrokeColor : 'transparent'}
                );
            } else {
                new Chart(chart).Doughnut(data,
                    {segmentStrokeColor : 'transparent'}
                );
            }

        });

    }


    /*
    **	Init tabs shortcode
    */
    function eltdInitTabs(){

       var tabs = $('.eltd-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this),
                    navLinks = thisTabs.find('.eltd-tabs-nav a');

                navLinks.each(function () {
                    var that = $(this),
                        link = that.attr('href'),
                        container = $(link),
                        linkSub = link.substr(1, link.length - 1),
                        customID = Math.floor(Math.random() * 10000);

                    if (container.length) {
                        container.attr({
                            'id' : linkSub + customID
                        });
                        that.attr({
                            'href' : link + customID
                        })
                    }
                });

                if(thisTabs.hasClass('eltd-horizontal')){
                    thisTabs.tabs();
                }
                else if(thisTabs.hasClass('eltd-vertical')){
                    var navItems = thisTabs.find('.eltd-tabs-nav li a');
                    var navWidth = navItems.first().width();
                    if(navItems.length){
                        navItems.each(function(){
                            var currentNavWidth = $(this).width();
                            if(currentNavWidth > navWidth){
                                navWidth = currentNavWidth;
                            }
                        });
                    }
                    thisTabs.find('.eltd-tabs-nav').css('width', navWidth+'px');
                    thisTabs.tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
                    thisTabs.find('.eltd-tabs-nav > ul >li').removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var eltdButton = eltd.modules.shortcodes.eltdButton = function() {
        //all buttons on the page
        var buttons = $('.eltd-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('border-color');
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };
    
    /*
    **	Init blog list masonry type
    */
    function eltdInitBlogListMasonry(){
        var blogList = $('.eltd-blog-list-holder.eltd-masonry .eltd-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);

                //appearance
                var animateOnTouch = $('.eltd-no-animations-on-touch');

                if(thisBlogList.length && !animateOnTouch.length){

                    $(this).find('li').css({opacity:0, marginTop:'40px'});

                    thisBlogList.appear(function(){
                        $(this).find('li').each(function(i){
                        var thisBlogListItem = $(this);
                        thisBlogListItem.delay(i*250).animate({opacity: 1, marginTop:0}, 300, 'easeOutSine');
                    });
                    }, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

                }
                
                thisBlogList.isotope({
                    itemSelector: '.eltd-blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.eltd-blog-list-masonry-grid-sizer',
                        gutter: '.eltd-blog-list-masonry-grid-gutter'
                    }
                });
            });

        }
    }

	/*
	**	Custom Font resizing
	*/
	function eltdCustomFontResize(){
		var customFont = $('.eltd-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (eltd.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (eltd.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (eltd.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (eltd.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (eltd.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && eltd.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && eltd.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function eltdShowGoogleMap(){

        if($('.eltd-google-map').length){
            $('.eltd-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "eltd-map-"+ uniqueId;

                eltdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function eltdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'eltd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Elated Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'eltd-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('eltd-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            eltdInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function eltdInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function eltdInitAccordions(){
        var accordion = $('.eltd-accordion-holder');
        if(accordion.length){
            accordion.each(function(){

               var thisAccordion = $(this);

				if(thisAccordion.hasClass('eltd-accordion')){

					thisAccordion.accordion({
						animate: "easeOutSine",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
                    
				}

				if(thisAccordion.hasClass('eltd-toggle')){
                    
                    var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.eltd-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();
                    
                    var firstToggleItem = toggleAccordionTitle.last();
                    firstToggleItem.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
                    firstToggleItem.next().toggleClass('ui-accordion-content-active').slideToggle(400);
                    
					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
            });
        }
    }

    function eltdInitImageGallery() {

        var galleries = $('.eltd-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.eltd-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                gallery.owlCarousel({
                    singleItem: true,
                    autoPlay: autoplay * 1000,
                    navigation: navigation,
                    transitionStyle : animation, //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: pagination,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }

    }
    /**
     * Initializes portfolio list
     */
    function eltdInitPortfolio(){
        var portList = $('.eltd-ptf-list-wrapper.eltd-ptf-standard, .eltd-ptf-list-wrapper.eltd-ptf-gallery, .eltd-ptf-list-wrapper.eltd-ptf-standard-with-space, .eltd-ptf-list-wrapper.eltd-ptf-gallery-with-space');
        if(portList.length){            
            portList.each(function(){
                var thisPortList = $(this);
                thisPortList.appear(function(){
                    eltdInitPortMixItUp(thisPortList);
                    eltd.modules.common.eltdInitParallax();
                    thisPortList.find('.eltd-ptf-list-paging').delay(300).animate({opacity:1},400);
                });
            });
        }
    }
    /**
     * Initializes mixItUp function for specific container
     */
    function eltdInitPortMixItUp(container){
        var filterClass = '';
        if(container.hasClass('eltd-ptf-has-filter')){
            filterClass = container.find('.eltd-portfolio-filter-holder-inner ul li').data('class');
            filterClass = '.'+filterClass;
        }
        
        var holderInner = container.find('.eltd-ptf-list-holder');

        holderInner.mixItUp({
            callbacks: {
                onMixLoad: function(){
                    holderInner.find('article').css({visibility:'visible'});
                    holderInner.find('article').animate({opacity:1}, 400, 'easeOutSine');
                    holderInner.mixItUp('setOptions', {
                        animation: {
                            effects: 'fade',
                            duration: 400,
                            easing: 'ease'
                        }
                    });
                    eltd.modules.common.eltdInitParallax();
                },
                onMixStart: function(){
                    holderInner.find('article').css('visibility','visible');
                    holderInner.find('article').addClass('loaded');
                },
                onMixBusy: function(){
                    holderInner.find('article').css('visibility','visible');
                }, 
                onMixEnd: function() {
                    eltd.modules.common.eltdInitParallax();
                }
            },           
            selectors: {
                filter: filterClass
            },
            animation: {
                effects: 'fade',
                duration: 400
            }
            
        });
        
    }
     /*
    **	Init portfolio list masonry type
    */
    function eltdInitPortfolioListMasonry(){
        var portList = $('.eltd-ptf-list-wrapper.eltd-ptf-masonry');
        if(portList.length) {
            portList.each(function() {

                var thisPortList = $(this).children('.eltd-ptf-list-holder');
                
                var size = thisPortList.find('.eltd-portfolio-list-masonry-grid-sizer').width();
                eltdResizeMasonry(size,thisPortList);
                
                eltdInitMasonry(thisPortList);
                $(window).resize(function(){
                    eltdResizeMasonry(size,thisPortList);
                    eltdInitMasonry(thisPortList);
                });
            });
        }
    }
    
    function eltdInitMasonry(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.eltd-portfolio-item',
            masonry: {
                columnWidth: '.eltd-portfolio-list-masonry-grid-sizer'
            }
        });
    }
    
    function eltdResizeMasonry(size,container){
        
        var defaultMasonryItem = container.find('.eltd-default-masonry-item');
        var largeWidthMasonryItem = container.find('.eltd-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.eltd-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.eltd-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeWidthMasonryItem.css('height', size);
        
        
        if(eltd.windowWidth > 600){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeHeightMasonryItem.css('height', Math.round(2*size));
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
        }
        
    }
    /**
     * Initializes portfolio pinterest 
     */
    function eltdInitPortfolioListPinterest(){
        
        var portList = $('.eltd-ptf-list-wrapper.eltd-ptf-pinterest');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.eltd-ptf-list-holder');
                eltdInitPinterest(thisPortList);
                $(window).resize(function(){
                     eltdInitPinterest(thisPortList);
                });
            });
            
        }
    }
    
    function eltdInitPinterest(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.eltd-portfolio-item',
            masonry: {
                columnWidth: '.eltd-portfolio-list-masonry-grid-sizer'
            }
        });
        
    }
    /**
     * Initializes portfolio masonry filter
     */
    function eltdInitPortfolioMasonryFilter(){
        
        var filterHolder = $('.eltd-portfolio-filter-holder.eltd-masonry-filter');
        
        if(filterHolder.length){
            filterHolder.each(function(){
               
                var thisFilterHolder = $(this);
                
                var portfolioIsotopeAnimation = null;
                
                var filter = thisFilterHolder.find('ul li').data('class');
                
                thisFilterHolder.find('.filter:first').addClass('current');
                
                thisFilterHolder.find('.filter').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(portfolioIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    portfolioIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s'); 
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.siblings('.eltd-ptf-list-wrapper').find('.eltd-ptf-list-holder').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });
                
            });
        }
    }
    /**
     * Initializes portfolio slider
     */
    
    function eltdInitPortfolioSlider(){
        var portSlider = $('.eltd-ptf-list-wrapper.eltd-portfolio-slider-holder');
        if(portSlider.length){
            portSlider.each(function(){
                var thisPortSlider = $(this);
                var sliderWrapper = thisPortSlider.children('.eltd-ptf-list-holder');
                var numberOfItems = thisPortSlider.data('items');
                var navigation = true;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                sliderWrapper.owlCarousel({                    
                    autoPlay: 5000,
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: true,
                    navigation: navigation,
                    slideSpeed: 600,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    navigationText: [
                        '<span class="eltd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="eltd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }
    }
    /**
     * Initializes portfolio load more function
     */
    function eltdInitPortfolioLoadMore(){
        var portList = $('.eltd-ptf-list-wrapper.eltd-ptf-load-more');
        if(portList.length){
            portList.each(function(){
                
                var thisPortList = $(this);
                var thisPortListInner = thisPortList.find('.eltd-ptf-list-holder');
                var nextPage; 
                var maxNumPages;
                var loadMoreButton = thisPortList.find('.eltd-ptf-list-load-more a');
                
                if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {  
                    maxNumPages = thisPortList.data('max-num-pages');
                }
                
                loadMoreButton.on('click', function (e) {  
                    var loadMoreDatta = eltdGetPortfolioAjaxData(thisPortList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    $(this).delay(100).animate({opacity:0},300);
                    e.stopPropagation(); 
                    if(nextPage <= maxNumPages){
                        var ajaxData = eltdSetPortfolioAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: eltdCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisPortList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = eltdConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with
                                thisPortList.waitForImages(function(){    
                                    setTimeout(function() {
                                        if(thisPortList.hasClass('eltd-ptf-masonry') || thisPortList.hasClass('eltd-ptf-pinterest') ){
                                            thisPortListInner.isotope().append( responseHtml ).isotope( 'appended', responseHtml ).isotope('reloadItems');
                                        } else {
                                            thisPortListInner.mixItUp('append',responseHtml);
                                        }
                                        loadMoreButton.delay(300).animate({opacity:1},300);
                                        thisPortList.find('article').addClass('loaded'); // animate opacity via CSS
                                    },400);                                    
                                });                           
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
                
            });
        }
    }
    
    function eltdConvertHTML ( html ) {
        var newHtml = $.trim( html ),
                $html = $(newHtml ),
                $empty = $();

        $html.each(function ( index, value ) {
            if ( value.nodeType === 1) {
                $empty = $empty.add ( this );
            }
        });

        return $empty;
    };
    /**
     * Initializes portfolio load more data params
     * @param portfolio list container with defined data params
     * return array
     */
    function eltdGetPortfolioAjaxData(container){
        var returnValue = {};
        
        returnValue.type = '';
        returnValue.columns = '';
        returnValue.gridSize = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.filter = '';
        returnValue.filterOrderBy = '';
        returnValue.category = '';
        returnValue.selectedProjectes = '';
        returnValue.showLoadMore = '';
        returnValue.titleTag = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.hideCategory = '';
        
        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {                    
            returnValue.gridSize = container.data('grid-size');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {                    
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {                    
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {                    
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {                    
            returnValue.number = container.data('number');
        }
        if (typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {                    
            returnValue.filter = container.data('filter');
        }
        if (typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {                    
            returnValue.filterOrderBy = container.data('filter-order-by');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {                    
            returnValue.selectedProjectes = container.data('selected-projects');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {                    
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {                    
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {                    
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {                    
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('hide-category') !== 'undefined' && container.data('hide-category') !== false) {                    
            returnValue.hideCategory = container.data('hide-category');
        }
        
        return returnValue;
    }
     /**
     * Sets portfolio load more data params for ajax function
     * @param portfolio list container with defined data params
     * return array
     */
    function eltdSetPortfolioAjaxData(container){
        var returnValue = {
            action: 'eltd_cpt_portfolio_ajax_load_more',
            type: container.type,
            columns: container.columns,
            gridSize: container.gridSize,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            filter: container.filter,
            filterOrderBy: container.filterOrderBy,
            category: container.category,
            selectedProjectes: container.selectedProjectes,
            showLoadMore: container.showLoadMore,
            titleTag: container.titleTag,
            nextPage: container.nextPage,
            hideCategory: container.hideCategory
        };
        return returnValue;
    }

    /*
    **	Boxes which reveal text on hover
    */
    function eltdInitCoverBoxes(){
        var container = $('.eltd-cover-boxes-holder');
        if(container.length) {
            container.each(function(){
                var thisContainer = $(this);
                
                if(eltd.windowWidth > 768){
                    
                    var active_element = 0;

                    //appearance
                    thisContainer.appear(function(){
                        var coverItem = $(this).find('li').eq(active_element);
                        var idleCoverItem = $(this).find('li').not(':first');

                        coverItem.addClass('eltd-cover-current');
                        idleCoverItem.each(function (l) {
                            var k = $(this);
                            setTimeout(function() {
                              k.addClass('appeared');
                            }, l*400); // delay 400 ms
                        });

                    }, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

                    thisContainer.find('li').each(function(l){

                        var width = thisContainer.width();
 
                        $(this).find('.eltd-cover-thumb').css({'width': Math.round(width/2) + 'px'});
                        
                        if(thisContainer.hasClass('eltd-cover-two-columns')) {
                            $(this).find('.eltd-cover-box-content').css({'width': Math.round(width/3) + 'px'});
                        } else {
                            $(this).find('.eltd-cover-box-content').css({'width': Math.round(width/4) + 'px'});
                        }

                        var hoveredItem = $(this);
                        hoveredItem.hover(function() {
                           thisContainer.find('li').removeClass('eltd-cover-current');
                           hoveredItem.addClass('eltd-cover-current');
                        });
                    });
                    
                }else{
                    thisContainer.find('li').removeClass('eltd-cover-current');
                }

            });
        }
    }


    /*
    * Section titles animation
    */

    function eltdInitSectionTitle(){

        var sectionSelectors = $('.no-touch .eltd-section-title-outer-holder.animate');
        var appearCoeff = eltd.windowHeight/5;

        if(sectionSelectors.length){
            sectionSelectors.each(function(){
                var sectionTitle = $(this);
                    sectionTitle.appear(function() {
                        sectionTitle.addClass('appeared');
                        eltd.modules.common.eltdInitParallax();                        
                    },{accX: 0, accY: -appearCoeff});
            });
        }        
    }


    /**
     * Slider object that initializes whole slider functionality
     * @type {Function}
     */
    var eltdSlider = eltd.modules.shortcodes.eltdSlider = function() {

        //all sliders on the page
        var sliders = $('.eltd-slider .carousel');
        //image regex used to extract img source
        var imageRegex = /url\(["']?([^'")]+)['"]?\)/;
        //default responsive breakpoints set
        var responsiveBreakpointSet = [1600,1200,900,650,500,320];
        //var init for coefficiens array
        var coefficientsGraphicArray;
        var coefficientsTitleArray;
        var coefficientsSubtitleArray;
        var coefficientsTextArray;
        var coefficientsButtonArray;
        //var init for slider elements responsive coefficients
        var sliderGraphicCoefficient;
        var sliderTitleCoefficient;
        var sliderSubtitleCoefficient;
        var sliderTextCoefficient;
        var sliderButtonCoefficient;
        var sliderTitleCoefficientLetterSpacing;
        var sliderSubtitleCoefficientLetterSpacing;
        var sliderTextCoefficientLetterSpacing;

        /*** Functionality for translating image in slide - START ***/

        var matrixArray = { zoom_center : '1.2, 0, 0, 1.2, 0, 0', zoom_top_left: '1.2, 0, 0, 1.2, -150, -150', zoom_top_right : '1.2, 0, 0, 1.2, 150, -150', zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150', zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'};

        // regular expression for parsing out the matrix components from the matrix string
        var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

        // parses a matrix string of the form "matrix(n1,n2,n3,n4,n5,n6)" and
        // returns an array with the matrix components
        var parseMatrix = function (val) {
            return val.match(matrixRE)[0].substr(1).
                split(",").map(function (s) {
                    return parseFloat(s);
                });
        };

        // transform css property names with vendor prefixes;
        // the plugin will check for values in the order the names are listed here and return as soon as there
        // is a value; so listing the W3 std name for the transform results in that being used if its available
        var transformPropNames = [
            "transform",
            "-webkit-transform"
        ];

        var getTransformMatrix = function (el) {
            // iterate through the css3 identifiers till we hit one that yields a value
            var matrix = null;
            transformPropNames.some(function (prop) {
                matrix = el.css(prop);
                return (matrix !== null && matrix !== "");
            });

            // if "none" then we supplant it with an identity matrix so that our parsing code below doesn't break
            matrix = (!matrix || matrix === "none") ?
                "matrix(1,0,0,1,0,0)" : matrix;
            return parseMatrix(matrix);
        };

        // set the given matrix transform on the element; note that we apply the css transforms in reverse order of how its given
        // in "transformPropName" to ensure that the std compliant prop name shows up last
        var setTransformMatrix = function (el, matrix) {
            var m = "matrix(" + matrix.join(",") + ")";
            for (var i = transformPropNames.length - 1; i >= 0; --i) {
                el.css(transformPropNames[i], m + ' rotate(0.01deg)');
            }
        };

        // interpolates a value between a range given a percent
        var interpolate = function (from, to, percent) {
            return from + ((to - from) * (percent / 100));
        };

        $.fn.transformAnimate = function (opt) {
            // extend the options passed in by caller
            var options = {
                transform: "matrix(1,0,0,1,0,0)"
            };
            $.extend(options, opt);

            // initialize our custom property on the element to track animation progress
            this.css("percentAnim", 0);

            // supplant "options.step" if it exists with our own routine
            var sourceTransform = getTransformMatrix(this);
            var targetTransform = parseMatrix(options.transform);
            options.step = function (percentAnim, fx) {
                // compute the interpolated transform matrix for the current animation progress
                var $this = $(this);
                var matrix = sourceTransform.map(function (c, i) {
                    return interpolate(c, targetTransform[i],
                        percentAnim);
                });

                // apply the new matrix
                setTransformMatrix($this, matrix);

                // invoke caller's version of "step" if one was supplied;
                if (opt.step) {
                    opt.step.apply(this, [matrix, fx]);
                }
            };

            // animate!
            return this.stop().animate({ percentAnim: 100 }, options);
        };

        /*** Functionality for translating image in slide - END ***/


        /**
         * Calculate heights for slider holder and slide item, depending on window width, but only if slider is set to be responsive
         * @param slider, current slider
         * @param defaultHeight, default height of slider, set in shortcode
         * @param responsive_breakpoint_set, breakpoints set for slider responsiveness
         * @param reset, boolean for reseting heights
         */
        var setSliderHeight = function(slider, defaultHeight, responsive_breakpoint_set, reset) {
            var sliderHeight = defaultHeight;
            if(!reset) {
                if(eltd.windowWidth > responsive_breakpoint_set[0]) {
                    sliderHeight = defaultHeight;
                } else if(eltd.windowWidth > responsive_breakpoint_set[1]) {
                    sliderHeight = defaultHeight * 0.75;
                } else if(eltd.windowWidth > responsive_breakpoint_set[2]) {
                    sliderHeight = defaultHeight * 0.6;
                } else if(eltd.windowWidth > responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.55;
                } else if(eltd.windowWidth <= responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.45;
                }
            }

            slider.css({'height': (sliderHeight) + 'px'});
            slider.find('.eltd-slider-preloader').css({'height': (sliderHeight) + 'px'});
            slider.find('.eltd-slider-preloader .eltd-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (sliderHeight) + 'px'});
        }

        /**
         * Calculate heights for slider holder and slide item, depending on window size, but only if slider is set to be full height
         * @param slider, current slider
         */
        var setSliderFullHeight = function(slider) {
            var mobileHeaderHeight = eltd.windowWidth < 1000 ? eltdGlobalVars.vars.eltdMobileHeaderHeight + $('.eltd-top-bar').height() : 0;
            slider.css({'height': (eltd.windowHeight - mobileHeaderHeight) + 'px'});            
            slider.find('.eltd-slider-preloader').css({'height': (eltd.windowHeight - mobileHeaderHeight) + 'px'});
            slider.find('.eltd-slider-preloader .eltd-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (eltd.windowHeight - mobileHeaderHeight) + 'px'});
        }

        /**
         * Set initial sizes for slider elements and put them in global variables
         * @param slideItem, each slide
         * @param index, index od slide item
         */
        var setSizeGlobalVariablesForSlideElements = function(slideItem, index) {
            window["slider_graphic_width_" + index] = [];
            window["slider_graphic_height_" + index] = [];
            window["slider_title_" + index] = [];
            window["slider_subtitle_" + index] = [];
            window["slider_text_" + index] = [];
            window["slider_button1_" + index] = [];
            window["slider_button2_" + index] = [];

            //graphic size
            window["slider_graphic_width_" + index].push(parseFloat(slideItem.find('.eltd-thumb img').data("width")));
            window["slider_graphic_height_" + index].push(parseFloat(slideItem.find('.eltd-thumb img').data("height")));

            // font-size (0)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.eltd-slide-title').css("font-size")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.eltd-slide-subtitle').css("font-size")));
            window["slider_text_" + index].push(parseFloat(slideItem.find('.eltd-slide-text').css("font-size")));
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(0)').css("font-size")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(1)').css("font-size")));

            // line-height (1)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.eltd-slide-title').css("line-height")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.eltd-slide-subtitle').css("line-height")));
            window["slider_text_" + index].push(parseFloat(slideItem.find('.eltd-slide-text').css("line-height")));
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(0)').css("line-height")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(1)').css("line-height")));

            // letter-spacing (2)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.eltd-slide-title').css("letter-spacing")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.eltd-slide-subtitle').css("letter-spacing")));
            window["slider_text_" + index].push(parseFloat(slideItem.find('.eltd-slide-text').css("letter-spacing")));
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(0)').css("letter-spacing")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(1)').css("letter-spacing")));

            // margin-bottom (3)
            window["slider_title_" + index].push(parseFloat(slideItem.find('.eltd-slide-title').css("margin-bottom")));
            window["slider_subtitle_" + index].push(parseFloat(slideItem.find('.eltd-slide-subtitle').css("margin-bottom")));


            // slider_button padding top/bottom(3), padding left/right(4)
            window["slider_button1_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(0)').css("padding-top")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(1)').css("padding-top")));

            window["slider_button1_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(0)').css("padding-left")));
            window["slider_button2_" + index].push(parseFloat(slideItem.find('.eltd-btn:eq(1)').css("padding-left")));

        }

        /**
         * Set responsive coefficients for slider elements
         * @param responsiveBreakpointSet, responsive breakpoints
         * @param coefficientsGraphicArray, responsive coeaficcients for graphic
         * @param coefficientsTitleArray, responsive coeaficcients for title
         * @param coefficientsSubtitleArray, responsive coeaficcients for subtitle
         * @param coefficientsTextArray, responsive coeaficcients for text
         * @param coefficientsButtonArray, responsive coeaficcients for button
         */
        var setSliderElementsResponsiveCoeffeicients = function(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray) {

            function coefficientsSetter(graphicArray,titleArray,subtitleArray,textArray,buttonArray){
                sliderGraphicCoefficient = graphicArray;
                sliderTitleCoefficient = titleArray;
                sliderSubtitleCoefficient = subtitleArray;
                sliderTextCoefficient = textArray;
                sliderButtonCoefficient = buttonArray;
            }

            if(eltd.windowWidth > responsiveBreakpointSet[0]) {
                coefficientsSetter(coefficientsGraphicArray[0],coefficientsTitleArray[0],coefficientsSubtitleArray[0],coefficientsTextArray[0],coefficientsButtonArray[0]);
            }else if(eltd.windowWidth > responsiveBreakpointSet[1]){
                coefficientsSetter(coefficientsGraphicArray[1],coefficientsTitleArray[1],coefficientsSubtitleArray[1],coefficientsTextArray[1],coefficientsButtonArray[1]);
            }else if(eltd.windowWidth > responsiveBreakpointSet[2]){
                coefficientsSetter(coefficientsGraphicArray[2],coefficientsTitleArray[2],coefficientsSubtitleArray[2],coefficientsTextArray[2],coefficientsButtonArray[2]);
            }else if(eltd.windowWidth > responsiveBreakpointSet[3]){
                coefficientsSetter(coefficientsGraphicArray[3],coefficientsTitleArray[3],coefficientsSubtitleArray[3],coefficientsTextArray[3],coefficientsButtonArray[3]);
            }else if (eltd.windowWidth > responsiveBreakpointSet[4]) {
                coefficientsSetter(coefficientsGraphicArray[4],coefficientsTitleArray[4],coefficientsSubtitleArray[4],coefficientsTextArray[4],coefficientsButtonArray[4]);
            }else if (eltd.windowWidth > responsiveBreakpointSet[5]){
                coefficientsSetter(coefficientsGraphicArray[5],coefficientsTitleArray[5],coefficientsSubtitleArray[5],coefficientsTextArray[5],coefficientsButtonArray[5]);
            }else{
                coefficientsSetter(coefficientsGraphicArray[6],coefficientsTitleArray[6],coefficientsSubtitleArray[6],coefficientsTextArray[6],coefficientsButtonArray[6]);
            }

            // letter-spacing decrease quicker
            sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient;
            sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient;
            sliderTextCoefficientLetterSpacing = sliderTextCoefficient;
            if(eltd.windowWidth <= responsiveBreakpointSet[0]) {
                sliderTitleCoefficientLetterSpacing = sliderTitleCoefficient/2;
                sliderSubtitleCoefficientLetterSpacing = sliderSubtitleCoefficient/2;
                sliderTextCoefficientLetterSpacing = sliderTextCoefficient/2;
            }
        };

        /**
         * Set sizes for slider elements
         * @param slideItem, each slide
         * @param index, index od slide item
         * @param reset, boolean for reseting sizes
         */
        var setSliderElementsSize = function(slideItem, index, reset) {

            if(reset) {
                sliderGraphicCoefficient = sliderTitleCoefficient = sliderSubtitleCoefficient = sliderTextCoefficient = sliderButtonCoefficient = sliderTitleCoefficientLetterSpacing = sliderSubtitleCoefficientLetterSpacing = sliderTextCoefficientLetterSpacing = 1;
            }

            slideItem.find('.eltd-thumb').css({
                "width": Math.round(window["slider_graphic_width_" + index][0]*sliderGraphicCoefficient) + 'px',
                "height": Math.round(window["slider_graphic_height_" + index][0]*sliderGraphicCoefficient) + 'px'
            });

            slideItem.find('.eltd-slide-title').css({
                "font-size": Math.round(window["slider_title_" + index][0]*sliderTitleCoefficient) + 'px',
                "line-height": Math.round(window["slider_title_" + index][1]*sliderTitleCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_title_" + index][2]*sliderTitleCoefficient) + 'px',
                "margin-bottom": Math.round(window["slider_title_" + index][3]*sliderTitleCoefficient) + 'px'
            });

            slideItem.find('.eltd-slide-subtitle').css({
                "font-size": Math.round(window["slider_subtitle_" + index][0]*sliderSubtitleCoefficient) + 'px',
                "line-height": Math.round(window["slider_subtitle_" + index][1]*sliderSubtitleCoefficient) + 'px',
                "margin-bottom": Math.round(window["slider_subtitle_" + index][3]*sliderSubtitleCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_subtitle_" + index][2]*sliderSubtitleCoefficientLetterSpacing) + 'px'
            });

            slideItem.find('.eltd-slide-text').css({
                "font-size": Math.round(window["slider_text_" + index][0]*sliderTextCoefficient) + 'px',
                "line-height": Math.round(window["slider_text_" + index][1]*sliderTextCoefficient) + 'px',
                "letter-spacing": Math.round(window["slider_text_" + index][2]*sliderTextCoefficientLetterSpacing) + 'px'
            });

        }

        /**
         * Set heights for slider and elemnts depending on slider settings (full height, responsive height od set height)
         * @param slider, current slider
         */
        var setHeights =  function(slider) {

            slider.find('.item').each(function (i) {
                setSizeGlobalVariablesForSlideElements($(this),i);
                setSliderElementsSize($(this), i, false);
            });

            if(slider.hasClass('eltd-full-screen')){
                
                setSliderFullHeight(slider);

                $(window).resize(function() {
                    setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);
                    setSliderFullHeight(slider);
                    slider.find('.item').each(function(i){
                        setSliderElementsSize($(this), i, false);
                    });
                });

            }else if(slider.hasClass('eltd-responsive-height')){

                var defaultHeight = slider.data('height');
                setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);

                $(window).resize(function() {
                    setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);
                    setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                    slider.find('.item').each(function(i){
                        setSliderElementsSize($(this), i, false);
                    });
                });

            }else {
                var defaultHeight = slider.data('height');

                slider.find('.eltd-slider-preloader').css({'height': (slider.height()) + 'px'});
                slider.find('.eltd-slider-preloader .eltd-ajax-loader').css({'display': 'block'});

                eltd.windowWidth < 1000 ? setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false) : setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);

                $(window).resize(function() {
                    setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);
                    if(eltd.windowWidth < 1000){
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                        slider.find('.item').each(function(i){
                            setSliderElementsSize($(this),i,false);
                        });
                    }else{
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);
                        slider.find('.item').each(function(i){
                            setSliderElementsSize($(this),i,true);
                        });
                    }
                });
            }
        }

        /**
         * Set prev/next numbers on navigation arrows
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         */
        var setPrevNextNumbers = function(slider, currentItem, totalItemCount) {
            if(currentItem == 1){
                slider.find('.left.carousel-control .prev').html(totalItemCount);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            }else if(currentItem == totalItemCount){
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(1);
            }else{
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            }
        }

        /**
         * Set video background size
         * @param slider, current slider
         */
        var initVideoBackgroundSize = function(slider){
            var min_w = 1500; // minimum video width allowed
            var video_width_original = 1920;  // original video dimensions
            var video_height_original = 1080;
            var vid_ratio = 1920/1080;

            slider.find('.item .eltd-video .eltd-video-wrap').each(function(){

                var slideWidth = eltd.windowWidth;
                var slideHeight = $(this).closest('.carousel').height();

                $(this).width(slideWidth);

                min_w = vid_ratio * (slideHeight+20);
                $(this).height(slideHeight);

                var scale_h = slideWidth / video_width_original;
                var scale_v = (slideHeight - eltdGlobalVars.vars.eltdMenuAreaHeight) / video_height_original;
                var scale =  scale_v;
                if (scale_h > scale_v)
                    scale =  scale_h;
                if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

                $(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
                $(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
                $(this).scrollLeft(($(this).find('video').width() - slideWidth) / 2);
                $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - slideHeight) / 2);
                $(this).scrollTop(($(this).find('video').height() - slideHeight) / 2);
            });
        }

        /**
         * Init video background
         * @param slider, current slider
         */
        var initVideoBackground = function(slider) {
            $('.item .eltd-video-wrap .video').mediaelementplayer({
                enableKeyboard: false,
                iPadUseNativeControls: false,
                pauseOtherPlayers: false,
                // force iPhone's native controls
                iPhoneUseNativeControls: false,
                // force Android's native controls
                AndroidUseNativeControls: false
            });

            $(window).resize(function() {
                initVideoBackgroundSize(slider);
            });

            //mobile check
            if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
                $('.eltd-slider .eltd-mobile-video-image').show();
                $('.eltd-slider .eltd-video-wrap').remove();
            }
        }        
         

        /**
         * initiate slider
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         * @param slideAnimationTimeout, timeout for slide change
         */
        var initiateSlider = function(slider, totalItemCount, slideAnimationTimeout) {

            //set active class on first item
            slider.find('.carousel-inner .item:first-child').addClass('active');
            //check for header style
            eltdCheckSliderForHeaderStyle($('.carousel .active'), slider.hasClass('eltd-header-effect'));
            eltdInitSlideNavigationStyle($('.carousel .active'));
            
            // setting numbers on carousel controls
            if(slider.hasClass('eltd-slider-numbers')) {
                setPrevNextNumbers(slider, 1, totalItemCount);
            }
            // set video background if there is video slide
            if(slider.find('.item video').length){
                initVideoBackgroundSize(slider);
                initVideoBackground(slider);
            }

            //init slider
            if(slider.hasClass('eltd-auto-start')){
                slider.carousel({
                    interval: slideAnimationTimeout,
                    pause: false
                });

                //pause slider when hover slider button
                slider.find('.slide_buttons_holder .qbutton')
                    .mouseenter(function() {
                        slider.carousel('pause');
                    })
                    .mouseleave(function() {
                        slider.carousel('cycle');
                    });
            } else {
                slider.carousel({
                    interval: 0,
                    pause: false
                });
            }


            //initiate image animation
            if($('.carousel-inner .item:first-child').hasClass('eltd-animate-image') && eltd.windowWidth > 1000){
                slider.find('.carousel-inner .item.eltd-animate-image:first-child .eltd-image').transformAnimate({
                    transform: "matrix("+matrixArray[$('.carousel-inner .item:first-child').data('eltd_animate_image')]+")",
                    duration: 30000
                });
            }

        }

        return {
            init: function() {
                if(sliders.length) {
                    sliders.each(function() {
                        var $this = $(this);
                        var slideAnimationTimeout = $this.data('slide_animation_timeout');
                        var totalItemCount = $this.find('.item').length;
                        if($this.data('eltd_responsive_breakpoints')){
                            if($this.data('eltd_responsive_breakpoints') == 'set2'){
                                responsiveBreakpointSet = [1600,1300,1000,768,567,320];
                            }
                        }
                        coefficientsGraphicArray = $this.data('eltd_responsive_graphic_coefficients').split(',');
                        coefficientsTitleArray = $this.data('eltd_responsive_title_coefficients').split(',');
                        coefficientsSubtitleArray = $this.data('eltd_responsive_subtitle_coefficients').split(',');
                        coefficientsTextArray = $this.data('eltd_responsive_text_coefficients').split(',');
                        coefficientsButtonArray = $this.data('eltd_responsive_button_coefficients').split(',');

                        setSliderElementsResponsiveCoeffeicients(responsiveBreakpointSet,coefficientsGraphicArray,coefficientsTitleArray,coefficientsSubtitleArray,coefficientsTextArray,coefficientsButtonArray);

                        setHeights($this);
                        
                        /*** wait until first video or image is loaded and than initiate slider - start ***/
                        if(eltd.htmlEl.hasClass('touch')){
                            if($this.find('.item:first-child .eltd-mobile-video-image').length > 0){
                                var src = imageRegex.exec($this.find('.item:first-child .eltd-mobile-video-image').attr('style'));
                            }else{
                                var src = imageRegex.exec($this.find('.item:first-child .eltd-image').attr('style'));
                            }
                            if(src) {
                                var backImg = new Image();
                                backImg.src = src[1];
                                $(backImg).load(function(){
                                    $('.eltd-slider-preloader').fadeOut(500);
                                    initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                });
                            }
                        } else {
                            if($this.find('.item:first-child video').length > 0){
                                $this.find('.item:first-child video').eq(0).one('loadeddata',function(){
                                    $('.eltd-slider-preloader').fadeOut(500);
                                    initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                });
                            }else{
                                var src = imageRegex.exec($this.find('.item:first-child .eltd-image').attr('style'));
                                if (src) {
                                    var backImg = new Image();
                                    backImg.src = src[1];
                                    $(backImg).load(function(){
                                        $('.eltd-slider-preloader').fadeOut(500);
                                        initiateSlider($this,totalItemCount,slideAnimationTimeout);
                                    });
                                }
                            }
                        }
                        /*** wait until first video or image is loaded and than initiate slider - end ***/

                        /* before slide transition - start */
                        $this.on('slide.bs.carousel', function () {
                            $this.addClass('eltd-in-progress');
                            $this.find('.active .eltd-slider-content-outer').fadeTo(250,0);
                        });
                        /* before slide transition - end */

                        /* after slide transition - start */
                        $this.on('slid.bs.carousel', function () {
                            $this.removeClass('eltd-in-progress');
                            $this.find('.active .eltd-slider-content-outer').fadeTo(0,1);

                            // setting numbers on carousel controls
                            if($this.hasClass('eltd-slider-numbers')) {
                                var currentItem = $('.item').index($('.item.active')[0]) + 1;
                                setPrevNextNumbers($this, currentItem, totalItemCount);
                            }

                            // initiate image animation on active slide and reset all others
                            $('.item.eltd-animate-image .eltd-image').stop().css({'transform':'', '-webkit-transform':''});
                            if($('.item.active').hasClass('eltd-animate-image') && eltd.windowWidth > 1000){
                                $('.item.eltd-animate-image.active .eltd-image').transformAnimate({
                                    transform: "matrix("+matrixArray[$('.item.eltd-animate-image.active').data('eltd_animate_image')]+")",
                                    duration: 30000
                                });
                            }
                        });
                        /* after slide transition - end */

                        /* swipe functionality - start */
                        $this.swipe( {
                            swipeLeft: function(){ $this.carousel('next'); },
                            swipeRight: function(){ $this.carousel('prev'); },
                            threshold:20
                        });
                        /* swipe functionality - end */

                    });
                }

                //adding parallax functionality on slider
                if($('.no-touch .carousel').length){
                    var skrollr_slider = skrollr.init({
                        smoothScrolling: false,
                        forceHeight: false
                    });
                    skrollr_slider.refresh();
                }
                

                $(window).scroll(function(){
                    //set control class for slider in order to change header style
                    if($('.eltd-slider .carousel').height() < eltd.scroll){
                        $('.eltd-slider .carousel').addClass('eltd-disable-slider-header-style-changing');
                    }else{
                        $('.eltd-slider .carousel').removeClass('eltd-disable-slider-header-style-changing');
                        eltdCheckSliderForHeaderStyle($('.eltd-slider .carousel .active'),$('.eltd-slider .carousel').hasClass('eltd-header-effect'));
                        eltdInitSlideNavigationStyle($('.eltd-slider .carousel .active'));
                    }
                    
                    //hide slider when it is out of viewport
                    if($('.eltd-slider .carousel').hasClass('eltd-full-screen') && eltd.scroll > eltd.windowHeight && eltd.windowWidth > 1000){
                        $('.eltd-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                    }else if(!$('.eltd-slider .carousel').hasClass('eltd-full-screen') && eltd.scroll > $('.eltd-slider .carousel').height() && eltd.windowWidth > 1000){
                        $('.eltd-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                    }else{
                        $('.eltd-slider .carousel').find('.carousel-inner, .carousel-indicators').show();
                    }

                });
            }
        };
    };

    /**
     * Check if slide effect on header style changing
     * @param slide, current slide
     * @param headerEffect, flag if slide
     */

    function eltdCheckSliderForHeaderStyle(slide, headerEffect) {

        if($('.eltd-slider .carousel').not('.eltd-disable-slider-header-style-changing').length > 0) {

            var slideHeaderStyle = "";
            if (slide.hasClass('light')) { slideHeaderStyle = 'eltd-light-header'; }
            if (slide.hasClass('dark')) { slideHeaderStyle = 'eltd-dark-header'; }

            if (slideHeaderStyle !== "") {
                if (headerEffect) {
                    eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(slideHeaderStyle);
                }
            } else {
                if (headerEffect) {
                    eltd.body.removeClass('eltd-dark-header eltd-light-header').addClass(eltd.defaultHeaderStyle);
                }

            }
        }
    }
    function eltdInitSlideNavigationStyle(activeSlide) {
       
        var currentNavColor = '';
        if(typeof activeSlide.data('eltd-slide-nav-color') !== 'undefined' && activeSlide.data('eltd-slide-nav-color') !== false) {
            currentNavColor = activeSlide.data('eltd-slide-nav-color');
        } 
        if(currentNavColor !==''){
            activeSlide.parent('.carousel-inner').siblings('.eltd-controls-holder').css('color', currentNavColor);   
        }else{
            activeSlide.parent('.carousel-inner').siblings('.eltd-controls-holder').css('color', '');
        }
         
    };

     /**
     * Animate unordered list
     */
    function eltdInitListAnimation(){

        var animateList = $('.eltd-animated-list');
        var animateOnTouch = $('.eltd-no-animations-on-touch');

        if(animateList.length && !animateOnTouch.length){
            animateList.each(function(){
                var thisList = $(this);
                var thisListLis = thisList.find("li");
                thisList.appear(function() {
                    thisListLis.each(function (l) {
                        var k = $(this);
                        setTimeout(function () {
                            k.animate({
                                opacity: 1,
                                left: 0
                            }, 200, 'easeOutSine');
                        }, 180*l);
                    });
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }
    }
    
     /**
     * Animate team
     */
    function eltdInitTeamAnimation(){

        var teamHolder = $('.eltd-team-holder');
        var animateOnTouch = $('.eltd-no-animations-on-touch');

        if(teamHolder.length && !animateOnTouch.length){
            teamHolder.each(function(){
                var thisTeamHolder = $(this);
                var thisTeamItem = thisTeamHolder.find(".eltd-team");
                thisTeamHolder.appear(function() {
                    thisTeamItem.each(function (l) {
                        var k = $(this);
                        setTimeout(function() {
                          k.addClass('appeared');
                        }, l*250); // delay 250 ms
                    });
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }
    }

    /*
    * Animate pricing table
    */

    function eltdInitPricingtableAnimation() {
        var pricingTableHolder = $('.eltd-pricing-tables');
        var animateOnTouch = $('.eltd-no-animations-on-touch');

        if(pricingTableHolder.length && !animateOnTouch.length) {
            pricingTableHolder.each(function(){

                var thisPricingTableHolder = $(this);
                var thisPricingTable = thisPricingTableHolder.find('.eltd-price-table');
                thisPricingTable.css({opacity:0});

                thisPricingTableHolder.appear(function(){
                    thisPricingTable.each(function(i){
                        var k = $(this);
                        var kHeight = k.outerHeight();
                        k.css({height:0});
                        k.delay(i*120).animate({height:kHeight+'px', opacity:1}, 1000, 'easeOutSine'); 
                    });
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

            });

        }
    }



    if ($('.eltd-image-waterfall').length) {
        var eltdIW = new function() {

            this.handle_viewport = function() {
                eltdIW.content.height(eltd.windowHeight);
                eltdIW.container.height(eltdIW.images.filter('.main').length * eltd.windowHeight);
                eltdIW.init_images();
                eltdIW.position();
            };

            this.init_images = function() {
                var main_image = [], side_image = [];
                var i = 0, j = 0;
                eltdIW.images.each(function() { // assuming side images come before their corresponding main image
                    if ($(this).is('.main')) {
                        side_image[i] = (typeof side_image[i] === 'undefined') ? [] : side_image[i];
                        main_image[i++] = $(this);
                        j = 0;
                    }
                    else if ($(this).is('.side')) {
                        side_image[i] = (typeof side_image[i] === 'undefined') ? [] : side_image[i];
                        side_image[i][j++] = $(this);
                    }
                });
                for (i=0; i<main_image.length; i++) {
                    var main_w = main_image[i].width();
                    var main_h = main_image[i].height() + (i ? 0 : eltdIW.heading.height());
                    var main_t = i*eltd.windowHeight + eltd.windowHeight/2 - main_h/2;
                    var main_l = eltd.windowWidth/2 - main_w/2;
                    if (!i) {
                        var heading_t = main_t + main_image[i].height();
                    }
                    main_image[i].css({
                        'top': main_t + 'px',
                        'left': main_l + 'px'
                    });
                    for (j=0; j<side_image[i].length; j++) {
                        side_image[i][j].css({
                            'top': main_t + main_h * side_image[i][j].data('top')/100 + 'px',
                            'left': main_l + main_w * side_image[i][j].data('left')/100 + 'px',
                            'width': side_image[i][j].data('width')/100 * main_w + 'px'
                        });
                    }
                }

                eltdIW.titles.each(function(i) {
                    var title = $(this);
                    title.css({
                        'top': eltd.windowHeight * 0.7 + i*eltd.windowHeight*eltdIW.title_dist_scale + 'px'
                    });
                });

                eltdIW.heading.css({
                    'top': heading_t + 'px'
                });
            };

            this.init = function() {
                eltd.modules.common.eltdDisableScroll();
                eltdIW.container = $('.eltd-image-waterfall');
                eltdIW.content = eltdIW.container.find('.eltd-iw-content');
                eltdIW.images = eltdIW.content.find('.eltd-iw-image');
                eltdIW.bgnds = eltdIW.content.find('.eltd-iw-bgnd');
                eltdIW.logos = eltdIW.content.find('.eltd-iw-logo');
                eltdIW.heading = eltdIW.content.find('.eltd-iw-heading');
                eltdIW.titles = eltdIW.content.find('.eltd-iw-title');
                eltdIW.title_dist_scale = 0.8;
                eltdIW.scroll_down = eltdIW.content.find('.eltd-iw-scroll-down');
                //eltdIW.last_scroll = eltd.scroll || $(window).scrollTop();
                eltdIW.sliding = false;
                eltdIW.entered_wheel = false;

                eltdIW.logos.each(function() {
                    $(this).width($(this).width()/2);
                });
                eltdIW.handle_viewport();
                //$(window).scroll(eltdIW.handle_scroll);
                eltdIW.container.on("mousewheel", eltdIW.handle_wheel);
                eltdIW.container.on("DOMMouseScroll", eltdIW.handle_wheel);
                //$(window).on("keydown", eltdIW.handle_keys);
                $(window).on("touchstart", eltdIW.handle_touchstart);
                $(window).on("touchmove", eltdIW.handle_touchmove);
                $(window).scroll(eltdIW.position);
                $(window).resize(eltdIW.handle_viewport);
                setTimeout(function() {
                    $(window).scrollTop(0)
                },50);
            };

            this.move_view = function(dir) {
                if (!eltdIW.sliding) {
                    var min_scr = 0, max_scr = eltd.body.height() - eltd.windowHeight;
                    var scr = eltd.scroll || $(window).scrollTop();
                    //eltd.body.animate({scrollTop: Math.max(min_scr, Math.min(Math.round((scr + (dir=='up' ? -1 : 1)*eltd.windowHeight)/eltd.windowHeight)*eltd.windowHeight, max_scr)) + 'px'}, 0, function() {
                    //    console.log('animated');
                    //});
                    $(window).scrollTop(Math.max(min_scr, Math.min(Math.round((scr + (dir=='up' ? -1 : 1)*eltd.windowHeight)/eltd.windowHeight)*eltd.windowHeight, max_scr)));
                }
            };

            this.handle_touchstart = function(e) {
                eltdIW.touch_start = e.originalEvent.touches[0].screenY;
            };

            this.handle_touchmove = function(e) {
                if ($(e.target).parents('.eltd-image-waterfall').length) {
                    e.preventDefault();
                }
                if (!eltdIW.sliding) {
                    if (!eltdIW.touch_start || Math.abs(eltdIW.touch_start - e.originalEvent.touches[0].screenY) < 50) {
                        return;
                    } else if (eltdIW.touch_start > e.originalEvent.touches[0].screenY) {
                        // move down
                        //console.log(eltdIW.touch_start + ' -> ' + e.originalEvent.touches[0].screenY);
                        eltdIW.touch_start = e.originalEvent.touches[0].screenY;
                        eltdIW.entered_wheel = true;
                        eltdIW.move_view('down');
                    } else if (eltdIW.touch_start < e.originalEvent.touches[0].screenY) {
                        // move up
                        //console.log(eltdIW.touch_start + ' -> ' + e.originalEvent.touches[0].screenY);
                        eltdIW.touch_start = e.originalEvent.touches[0].screenY;
                        eltdIW.entered_wheel = true;
                        eltdIW.move_view('up');
                    }
                }
            };

            this.handle_wheel = function(e) {
                //console.log('tocak');
                if (!eltdIW.sliding) {
                    eltdIW.entered_wheel = true;
                    e = window.event || e.originalEvent;
                    var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
                    if (delta == 1) {
                        eltdIW.move_view('up');
                    }
                    else if (delta == -1) {
                        eltdIW.move_view('down');
                    }

                    /*
                    var scr = eltd.scroll || $(window).scrollTop();
                    //var round_scr = Math.round(scr/eltd.windowHeight) * eltd.windowHeight;
                    if (scr > eltdIW.last_scroll) { // down
                        console.log('down '+ scr);
                        $(window).scrollTop(Math.ceil(scr/eltd.windowHeight) * eltd.windowHeight);
                    }
                    else if (scr < eltdIW.last_scroll) { // up
                        console.log('up ' + scr);
                        $(window).scrollTop(Math.floor(scr/eltd.windowHeight) * eltd.windowHeight);
                    }
                    if (scr % eltd.windowHeight == 0) {
                        eltdIW.last_scroll = scr;
                    }
                    */
                }
            };

            this.position = function() {
                if (eltdIW.sliding) return;
                //console.log('pozicija');
                var scr = eltd.scroll || $(window).scrollTop();
                var cont_top = eltdIW.container.offset().top;
                var cont_h = eltdIW.container.height();
                var win_pos = '';
                if (cont_top - scr > 0) {
                    win_pos = 'above';
                }
                else if (cont_top - scr <= 0 && scr + eltd.windowHeight <= cont_top + cont_h) {
                    win_pos = 'in';
                    /*if (scr > cont_top && scr < cont_top + eltd.windowHeight) {
                        $(window).scrollTop(cont_top + eltd.windowHeight);
                        return;
                    }*/
                }
                else if (scr + eltd.windowHeight > cont_top + cont_h) {
                    win_pos = 'below';
                }

                eltdIW.content.css({
                    'top': ( win_pos == 'above' ? (cont_top - scr) : ( win_pos == 'below' ? (cont_top + cont_h - scr - eltd.windowHeight) : 0) ) + 'px'
                });
            
                //eltdIW.images.css({
                    //'margin-top': -(scr - cont_top) + 'px'
                //});
                eltdIW.sliding = true;
                eltdIW.images.filter('.main').stop(true).animate({
                    'margin-top': -(scr - cont_top) + 'px'
                }, 1200 * (eltdIW.entered_wheel ? 1 : 0.01), 'easeOutSine');
                eltdIW.images.filter('.side').stop(true).animate({
                    'margin-top': -(scr - cont_top) + 'px'
                }, 1400 * (eltdIW.entered_wheel ? 1 : 0.01), 'easeOutSine', function() {
                    eltdIW.sliding = false;
                });

                eltdIW.titles.stop(true).animate({
                    'margin-top': -(scr - cont_top)*eltdIW.title_dist_scale + 'px'
                }, 1200 * (eltdIW.entered_wheel ? 1 : 0.01), 'easeOutSine');

                eltdIW.heading.stop(true).animate({
                    'margin-top': -(scr - cont_top)*eltdIW.title_dist_scale + 'px'
                }, 1200 * (eltdIW.entered_wheel ? 1 : 0.01), 'easeOutSine');
                    
                eltdIW.entered_wheel = false;
                
                eltdIW.set_opacities(win_pos);
            };

            this.set_opacities = function(win_pos) {
                var scr = eltd.scroll || $(window).scrollTop();
                var bar = 0.75; // has to be greater than 0.5 (jump transition) and smaller than 1 (smoothest transition). 
                var cont_top = eltdIW.container.offset().top;
                var cont_h = eltdIW.container.height();
                var progress = (scr - cont_top) / (eltd.windowHeight);
                eltdIW.scroll_down.stop(true).animate({'opacity': 1 - Math.max(0, Math.min(progress * 10, 1))}, 500);
                eltdIW.bgnds.each(function(i) {
                    var targets = $(this).add(eltdIW.logos.eq(i));
                    if (progress < i-bar) { // before, opacity 0, except for the first one
                        if (i!=0) { 
                            targets.css('opacity',0); 
                        }
                        else if (i==0 && progress < 0) {
                            targets.css('opacity',1);
                        }
                    }
                    else if (progress >= i-bar && progress <= i+bar) { // variable opacity
                        if (i==0 && progress < 0 || i==eltdIW.bgnds.length-1 && progress > eltdIW.bgnds.length-1) {
                            targets.css('opacity',1);
                        }
                        else {
                            targets.css('opacity', Math.min(1, 1/(1-2*bar) * Math.abs(progress-i) + bar / (2*bar-1)));
                        }
                    }
                    else { // after, opacity 0, except for the last one
                        if (i<eltdIW.bgnds.length-1) { 
                            targets.css('opacity',0); 
                        }
                        else if (i==eltdIW.bgnds.length-1 && progress > eltdIW.bgnds.length-1) {
                            targets.css('opacity',1); 
                        }
                    }
                });
            };

        };

        $(window).load(eltdIW.init);

        shortcodes.eltdImageWaterfall = eltdIW;
    }


})(jQuery);
(function($) {
    'use strict';

    $(document).ready(function () {
        eltdInitQuantityButtons();
        eltdInitSelect2();
        eltdInitSingleProductLightbox();
    });

    function eltdInitQuantityButtons() {

        $(document).on( 'click', '.eltd-quantity-minus, .eltd-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.parent().siblings('.eltd-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('eltd-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            inputField.trigger( 'change' );

        });

    }

    function eltdInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

    }


    /*
     ** Init Product Single Pretty Photo attributes
     */
    function eltdInitSingleProductLightbox() {
        var item = $('.eltd-woocommerce-single-page .images .woocommerce-product-gallery__image');

        console.log(item);

        if(item.length) {
            item.children('a').attr('data-rel', 'prettyPhoto[product-gallery]');

            if (typeof eltd.modules.common.eltdPrettyPhoto === "function") {
                eltd.modules.common.eltdPrettyPhoto();
            }
        }
    }


})(jQuery);
(function($) {
    'use strict';

    eltd.modules.portfolio = {};

    $(window).load(function() {
        eltdPortfolioSingleFollow().init();
    });

    var eltdPortfolioSingleFollow = function() {

        var info = $('.eltd-follow-portfolio-info .small-images.eltd-portfolio-single-holder .eltd-portfolio-info-holder, ' +
            '.eltd-follow-portfolio-info .small-slider.eltd-portfolio-single-holder .eltd-portfolio-info-holder');

        if (info.length) {
            var infoHolder = info.parent(),
                infoHolderOffset = infoHolder.offset().top,
                infoHolderHeight = infoHolder.height(),
                mediaHolder = $('.eltd-portfolio-media'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .eltd-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(eltd.scroll > infoHolderOffset) {
                        info.animate({
                            marginTop: (eltd.scroll - (infoHolderOffset) + eltdGlobalVars.vars.eltdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                        });
                    }
                }

            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(eltd.scroll > infoHolderOffset) {

                        if(eltd.scroll + headerHeight + eltdGlobalVars.vars.eltdAddForAdminBar + infoHolderHeight + 20 < infoHolderOffset + mediaHolderHeight) {    //20 px is for styling, spacing between header and info holder

                            //Calculate header height if header appears
                            if ($('.header-appear, .eltd-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .eltd-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (eltd.scroll - (infoHolderOffset) + eltdGlobalVars.vars.eltdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
                            });
                            //Reset header height
                            headerHeight = 0;
                        }
                        else{
                            info.stop().animate({
                                marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {

            init : function() {

                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });

            }

        };

    };

})(jQuery);