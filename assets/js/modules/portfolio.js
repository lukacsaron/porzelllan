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