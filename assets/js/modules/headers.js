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