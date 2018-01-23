(function($) {
    "use strict";


    var blog = {};
    eltd.modules.blog = blog;

    blog.eltdInitAudioPlayer = eltdInitAudioPlayer;

    $(document).ready(function() {
        eltdInitAudioPlayer();
        eltdInitBlogMasonryLoadMore();
        eltdInitBlogListStandard();
    });

    $(window).load(function() {
        eltdInitBlogMasonry();        
    });

    function eltdInitAudioPlayer() {

        var players = $('audio.eltd-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }


    function eltdInitBlogMasonry() {

        if($('.eltd-blog-holder.eltd-blog-type-masonry').length) {

            var container = $('.eltd-blog-holder.eltd-blog-type-masonry');

            container.isotope({
                itemSelector: 'article',
                resizable: false,
                masonry: {
                    columnWidth: '.eltd-blog-masonry-grid-sizer',
                    gutter: '.eltd-blog-masonry-grid-gutter'
                }
            });

            var filters = $('.eltd-filter-blog-holder');
            $('.eltd-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.eltd-active').removeClass('eltd-active');
                filter.addClass('eltd-active');
                container.isotope({filter: selector});
                return false;
            });


            //appearance
            var animateOnTouch = $('.eltd-no-animations-on-touch');

            if(container.length && !animateOnTouch.length){

                container.appear(function(){
                    $(this).find('article .eltd-post-content').each(function(i){
                    var thisBlogListItem = $(this);
                    thisBlogListItem.delay(i*250).animate({opacity: 1, top:0}, 300, 'easeOutSine');
                });
                }, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});

            }
        }
    }

    function eltdInitBlogMasonryLoadMore() {

        if($('.eltd-blog-holder.eltd-blog-type-masonry').length) {

            var container = $('.eltd-blog-holder.eltd-blog-type-masonry');

            if(container.hasClass('eltd-masonry-pagination-infinite-scroll')) {
                container.infinitescroll({
                        navSelector: '.eltd-blog-infinite-scroll-button',
                        nextSelector: '.eltd-blog-infinite-scroll-button a',
                        itemSelector: 'article',
                        loading: {
                            finishedMsg: eltdGlobalVars.vars.eltdFinishedMessage,
                            msgText: eltdGlobalVars.vars.eltdMessage
                        }
                    },
                    function(newElements) {
                        container.append(newElements).isotope('appended', $(newElements));
                        eltd.modules.blog.eltdInitAudioPlayer();
                        eltd.modules.common.eltdOwlSlider();
                        eltd.modules.common.eltdFluidVideo();
                        setTimeout(function() {
                            container.isotope('layout');
                        }, 400);
                    }
                );
            } else if(container.hasClass('eltd-masonry-pagination-load-more')) {
                var i = 1;
                $('.eltd-blog-load-more-button a').on('click', function(e) {
                    e.preventDefault();

                    var button = $(this);

                    var link = button.attr('href');
                    var content = '.eltd-masonry-pagination-load-more';
                    var anchor = '.eltd-blog-load-more-button a';
                    var nextHref = $(anchor).attr('href');
                    $.get(link + '', function(data) {
                        var newContent = $(content, data).wrapInner('').html();
                        nextHref = $(anchor, data).attr('href');
                        container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        eltd.modules.blog.eltdInitAudioPlayer();
                        eltd.modules.common.eltdOwlSlider();
                        eltd.modules.common.eltdFluidVideo();
                        setTimeout(function() {
                            $('.eltd-masonry-pagination-load-more').isotope('layout');
                        }, 400);
                        if(button.parent().data('rel') > i) {
                            button.attr('href', nextHref); // Change the next URL
                        } else {
                            button.parent().remove();
                        }
                    });
                    i++;
                });
            }
        }
    }

    /*
    * Animate standard blog list appearance
    */

    function eltdInitBlogListStandard() {

        //vars
        var blogStandardTemplate = $('.page-template-blog-standard');
        var blogHolder = $('.eltd-blog-holder');
        var blogArticle = blogHolder.find('article');
        var animateOnTouch = $('.eltd-no-animations-on-touch');

        if((blogStandardTemplate.length || $("body.blog").length) && !animateOnTouch.length ){
            blogHolder.each(function(){
                blogArticle.appear(function(){
                    $(this).addClass('appeared');
                },{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }
    }


})(jQuery);