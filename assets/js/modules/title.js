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
