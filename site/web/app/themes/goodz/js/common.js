(function($) { 'use strict';

    $(document).ready(function($){

        // Remove table header if wishlist is empty
        if ( $( '.wishlist-empty' )[0] ) {
            $( '.wishlist-title' ).remove();
            $( '.wishlist_table thead' ).remove();
        }

    	// Calculate clients viewport
        function viewport() {
            var e = window, a = 'inner';
            if(!('innerWidth' in window )) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
        }

        var w=window,d=document,
        e=d.documentElement,
        g=d.getElementsByTagName('body')[0],
        x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
        y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

        // Global Vars

        var $window = $(window);
        var body = $('body');
        var wScrollTop = $window.scrollTop();
        var sidebar = $('#secondary');
        var mainHeader = $('#masthead');

		// Outline none on mousedown for focused elements

        body.on('mousedown', '*', function(e) {
            if(($(this).is(':focus') || $(this).is(e.target)) && $(this).css('outline-style') == 'none') {
                $(this).css('outline', 'none').on('blur', function() {
                    $(this).off('blur').css('outline', '');
                });
            }
        });

        // Retina Logo

        if($('.retina-logo img').length){
            var retinaImage = $('.retina-logo img');

            var imageLoaded = function () {
                var theImage = new Image();

                theImage.src = retinaImage.attr('src');

                var imageWidth = theImage.width;

                retinaImage.width(imageWidth / 2);
            };

            retinaImage.each(function() {
                if( this.complete ) {
                    imageLoaded.call( this );
                } else {
                    $(this).one('load', imageLoaded);
                }
            });
        }

        // Custom input number field

        var inputNum = $('input.input-text.qty');

        function customNumInput(){
            if(inputNum.length){
                inputNum.each(function(){
                    var thisInput = $(this);

                    thisInput.parent('.quantity').append('<a id="up" href="#">+</a><a id="down" href="#">-</a>');
                    var adjustVal = thisInput.siblings('a');

                    adjustVal.on('click', function(e){
                        var minVal = parseInt(thisInput.attr('min'));
                        var maxVal = parseInt(thisInput.attr('max'));
                        e.preventDefault();
                        var $this = $(this);
                        var value = parseInt(thisInput.val());
                        if (isNaN(minVal)){
                            minVal = 0;
                        }

                        if (isNaN(maxVal)){
                            maxVal = Number.MAX_VALUE;
                        }

                        if ($this.is('#down') && (value > minVal)){
                            value--;
                        }
                        else if ($this.is('#up') && (value < maxVal)){
                            value++;
                        }
                        thisInput.val(value);
                    });
                });
            }
        }

        customNumInput();

        // Main Header

        // dropdown menu

        var mainMenuDropdownLink = $('.nav-menu .menu-item-has-children > a, .nav-menu .page_item_has_children > a');
        var dropDownArrow = $('<a href="#" class="dropdown-toggle"><span class="screen-reader-text">toggle child menu</span></a>');

        if(x > 1024 && (mainHeader.hasClass('transparent-header'))){

            var mainMenuDropdown = $('.mega-menu-dropdown');

            mainMenuDropdown
            .mouseenter(function(){
                $(this).closest('.site-header').addClass('background-change');
            })
            .mouseleave(function() {
                $(this).closest('.site-header').removeClass('background-change');
            });
        }

        mainMenuDropdownLink.after(dropDownArrow);

        // dropdown open on click

        var dropDownButton = mainMenuDropdownLink.next('a.dropdown-toggle');

        dropDownButton.click(function(e){
            e.preventDefault();
            var $this = $(this);
            $this.parent('li').toggleClass('toggle-on').siblings().removeClass('toggle-on').find('.toggle-on').removeClass('toggle-on');
        });

        // big search field

        var bigSearchWrap = $('div.search-wrap');
        var bigSearchField = bigSearchWrap.find('.search-field');
        var bigSearchTrigger = $('#big-search-trigger');
        var bigSearchClose = bigSearchWrap.add('#big-search-close');

        bigSearchClose.on('touchend click', function(){
            var $this = $(this);
            if(body.hasClass('big-search')){
                body.removeClass('big-search');
                setTimeout(function(){
                    $this.siblings('.search-wrap').find('.search-field').blur();
                }, 100);
            }
        });

        bigSearchTrigger.on('touchend click', function(e){
            e.preventDefault();
            e.stopPropagation();
            var $this = $(this);
            body.addClass('big-search');
            setTimeout(function(){
                $this.siblings('.search-wrap').find('.search-field').focus();
            }, 100);
        });

        bigSearchField.on('touchend click', function(e){
            e.stopPropagation();
        });


        bigSearchField.attr({placeholder: 'Start Searching', autocomplete: 'off'});

        // Checkbox and Radio buttons

        //if buttons are inside label
        function radio_checkbox_animation() {
            var checkBtn = $('label').find('input[type="checkbox"]');
            var checkLabel = checkBtn.parent('label');
            var radioBtn = $('label').find('input[type="radio"]');

            checkLabel.addClass('checkbox');

            checkLabel.click(function(){
                var $this = $(this);
                if($this.find('input').is(':checked')){
                    $this.addClass('checked');
                }
                else{
                    $this.removeClass('checked');
                }
            });

            var checkBtnAfter = $('label + input[type="checkbox"]');
            var checkLabelBefore = checkBtnAfter.prev('label');

            checkLabelBefore.click(function(){
                var $this = $(this);
                $this.toggleClass('checked');
            });

            radioBtn.change(function(){
                var $this = $(this);
                if($this.is(':checked')){
                    $this.parent('label').siblings().removeClass('checked');
                    $this.parent('label').addClass('checked');
                }
                else{
                    $this.parent('label').removeClass('checked');
                }
            });
        }
        radio_checkbox_animation();

        // Featured slider

        var featuredSlider = $('div.featured-slider');

        if(featuredSlider.length){

            var featuredSliderItem = featuredSlider.find('article');
            var sliderPreloader = $('.featured-slider-wrap + div.slider-preloader');
            var featuredSliderHeader = featuredSlider.find('.entry-header');

            featuredSliderHeader.hover(
                function(){
                    $(this).closest('.featured-slider').addClass('opaque');
                },
                function() {
                    $(this).closest('.featured-slider').removeClass('opaque');
            });

            if(featuredSliderItem.length <= 1){
                sliderPreloader.hide();
            }

            var initializeFeaturedSlider = function(){

                sliderPreloader.fadeOut(300);

                featuredSlider.addClass('loaded');

                featuredSlider.slick({
                    slide: 'article',
                    infinite: true,
                    speed: 600,
                    useTransform: true,
                    centerMode: true,
                    centerPadding: 0,
                    draggable: false,
                    initialSlide: 0,
                    dots: false,
                    touchThreshold: 20,
                    slidesToShow: 1,
                    cssEase: 'cubic-bezier(0,.4,.1,1)',
                    responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            dots: true,
                            draggable: true
                        }
                    }
                  ]
                });
            };

            var msieversion = function() {

                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");

                if(msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
                    initializeFeaturedSlider();
                }

               return false;
            };

            msieversion();

            var sliderFunctions = function() {

                var notIE = function() {

                    var ua = window.navigator.userAgent;
                    var msie = ua.indexOf("MSIE ");

                    if(!(msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))){
                        initializeFeaturedSlider();
                    }

                   return false;
                };

                notIE();

                if(body.hasClass('featured-slider-fullwidth')){
                    var htmlOffsetTop = parseInt($('html').css('margin-top'));
                    var featuredSliderHeight = featuredSlider.outerHeight();
                    var mainHeader = $('#masthead');
                    var headerHeight = mainHeader.outerHeight();

                    $('.site-content > .container').wrap('<div class="main-content-wrap"></div>');

                    var wScrollTop = $(window).scrollTop();

                    if(x > 1024){

                        $('.main-content-wrap').css({marginTop: featuredSliderHeight});

                        var featuredSliderDefaultHeader = function() {
                            if(wScrollTop > headerHeight - 4){
                                featuredSlider.css({opacity: ( featuredSliderHeight - wScrollTop + headerHeight ) / featuredSliderHeight});
                            }
                            else{
                                featuredSlider.css({opacity: 1});
                            }
                        };
                        featuredSliderDefaultHeader();

                        $(window).scroll(function(){
                            wScrollTop = $(window).scrollTop();
                            featuredSliderDefaultHeader();
                        });
                    }
                }
            };

            var featuredImagesLoaded = function () {
                counter--;
                if( counter === 0 ) {
                    sliderFunctions();
                }
            };

            var featuredSliderImg = featuredSlider.find('img');
            var counter = featuredSliderImg.length;

            featuredSliderImg.each(function() {
                if( this.complete ) {
                    featuredImagesLoaded.call( this );
                } else{
                    $(this).one('load', featuredImagesLoaded);
                }
            });

            if(!featuredSliderImg.length){
                sliderFunctions();
            }
        }

        // Gallery slider

        var gallerySlider = $('.entry-gallery .gallery-size-full');

        if(gallerySlider.length){

            var initializeGallerySlider = function(){

                gallerySlider.each(function(){
                    var $this = $(this);
                    var gallerySliderPreloader = $('.entry-gallery + div.slider-preloader');
                    $this.addClass('loaded');

                    gallerySliderPreloader.fadeOut(300);

                    $this.slick({
                        infinite: true,
                        speed: 400,
                        useTransform: true,
                        centerMode: true,
                        centerPadding: 0,
                        draggable: false,
                        slidesToShow: 1,
                        cssEase: 'ease-out',
                        responsive: [
                        {
                          breakpoint: 1025,
                          settings: {
                            draggable: true
                          }
                        },
                        {
                        breakpoint: 768,
                        settings: {
                            dots: true
                        }
                    }
                      ]
                    });
                });

            };

            var msieversion = function() {

                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");

                if(msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
                    initializeGallerySlider();
                }

               return false;
            };

            msieversion();

            var galleryImagesLoaded = function () {

               galleryCounter--;
               if( galleryCounter === 0 ) {

                    var notIE = function() {

                        var ua = window.navigator.userAgent;
                        var msie = ua.indexOf("MSIE ");

                        if(!(msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))){
                            initializeGallerySlider();
                        }

                       return false;
                    };

                    notIE();

                }
            };
            var galleryImg = gallerySlider.find('img');
            var galleryCounter = galleryImg.length;

            galleryImg.each(function() {
                if( this.complete ) {
                    galleryImagesLoaded.call( this );
                } else{
                    $(this).one('load', galleryImagesLoaded);
                }
            });

        }

        // Animate grid items

        var gridItem = $('.grid-wrapper article.post, .grid-wrapper article.page');

        gridItem.each(function(i){
            setTimeout(function(){
                gridItem.eq(i).addClass('post-loaded animate');
            }, 200 * (i+1));
        });

        var $container    = $('div.grid-wrapper'),
            loadingImg    = js_vars.url + '/img/spinner.gif',
            no_more_posts = js_vars.no_more_text,
            loadNumber    = 1;

        $container.infinitescroll({
            navSelector  : '#infinite-handle',    // selector for the paged navigation
            nextSelector : '#infinite-handle .nav-previous a',  // selector for the NEXT link (to page 2)
            itemSelector : '.hentry',
            loading: {
                finishedMsg: no_more_posts,
                msgText: '',
                img: loadingImg,
                selector: '#loading-is'
            }
        },
        function(){

            radio_checkbox_animation();

            // Reactivate masonry on post load

            var newEl = $container.children().not('article.post-loaded, span.infinite-loader').addClass('post-loaded');


            newEl.each(function(){
                var wScrollTop = $(window).scrollTop();
                var $this = $(this);
                if(x >= 992){
                    if(wScrollTop > $this.offset().top - ($(window).height() / 1.1)){
                        $this.addClass('animate');
                    }
                }
                else{
                    if(wScrollTop > $this.offset().top - ($(window).height() / 1.2)){
                        $this.addClass('animate');
                    }
                }
                if($this.has('.entry-gallery .gallery-size-full')){
                    $this.find('.gallery-size-full').addClass('loaded').slick();
                }
            });

            $(window).scroll(function(){
                var wScrollTop = $(window).scrollTop();
                newEl.each(function(){
                    var $this = $(this);
                    if(x >= 992){
                        if(wScrollTop > $this.offset().top - ($(window).height() / 1.1)){
                            $this.addClass('animate');
                        }
                    }
                    else{
                        if(wScrollTop > $this.offset().top - ($(window).height() / 1.2)){
                            $this.addClass('animate');
                        }
                    }
                });
            });

            // The maximum number of pages the current query can return.
            var max = parseInt( js_vars.maxPages );
            loadNumber++;

            if ( js_vars.is_type == 'click' && loadNumber < max ) {
                // Display Load More button
                $('#infinite-handle').show();
            }

        });

        // If Infinite Scroll on click is choosen
        if ( 'infinite_scroll' == js_vars.paging_type && js_vars.is_type == 'click' ) {

            //Onclick InfiniteScroll
            $(window).unbind('.infscr');

            $('#infinite-handle .nav-previous a').click(function(e){
                e.preventDefault();

                $container.infinitescroll('retrieve');
                return false;
            });

        }

        // Contact Form

        var contactForm = $('form.contact-form');

        if(contactForm.length){
            var contactSubmit = contactForm.find('input[type="submit"]');
            var halfWidthInputs = contactForm.find('input[type=text], input[type=email]').parent();
            var halfWidthInputsOdd =  halfWidthInputs.filter(function(index) {
                return (index + 1) % 2 === 0;
            });
            contactSubmit.attr({value: 'Submit'});
            halfWidthInputs.addClass('half-width');
            halfWidthInputsOdd.addClass('last');
        }

        // Fancybox

        $('.fancybox').fancybox({
            openOpacity: false,
            closeOpacity: false,
            openEffect: 'none',
            closeEffect: 'none',
            openSpeed: 0,
            closeSpeed: 0,
            helpers: {
                media: {}
            }
        });

        // Single post share

        var shareIconsWrap = $('.fullwidth-single .has-sidebar .sd-social-icon, .fullwidth-single .has-sidebar .tkss-post-share');

        if(shareIconsWrap.length){

            var shareIconsWrapWidth = shareIconsWrap.outerWidth();

            if(x > 1440){
                shareIconsWrap.parent().css({paddingLeft: shareIconsWrapWidth});
            }
            else{
                shareIconsWrap.parent().css({paddingLeft: ''});
            }

        }

        // IE Placeholders

        if (document.addEventListener && !window.requestAnimationFrame){
            $('input, textarea').placeholder();
        }


	}); // End Document Ready

	$(window).load(function(){

        // Calculate clients viewport

        function viewport() {
            var e = window, a = 'inner';
            if(!('innerWidth' in window )) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
        }

        var w=window,d=document,
        e=d.documentElement,
        g=d.getElementsByTagName('body')[0],
        x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
        y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

        // Global Vars

        var $window = $(window);
        var body = $('body');
        var mainHeader = $('#masthead');

        body.addClass('page-loaded');

        // Main Header

        // dropdown menu

        if(x > 1024){

            var mainMenuDropdown = $('.mega-menu-dropdown');
            var htmlOffsetTop = parseInt($('html').css('margin-top'));

            mainMenuDropdown.each(function(){
                var $this = $(this);
                var mainMenuDropdownOffsetTop = $this.offset().top + $this.outerHeight() - htmlOffsetTop;

                $this.children('ul').css({top: (mainMenuDropdownOffsetTop)});
            });
        }

        // Masonry call

        var masonryItems = $('.archive .grid-wrapper > figure, body:not(.page-template-template-front-page) .grid-wrapper > .product');

        if(masonryItems.length){

            var $container = $('.archive div.grid-wrapper');
            var columnSizer;

            if(body.hasClass('.woocommerce.archive')){
                if(x > 767){
                    columnSizer = 4;
                }
                else if(x < 768 && x >= 480){
                    columnSizer = 2;
                }
                else {
                    columnSizer = 1;
                }
            }

            else if(body.hasClass('home')){
                columnSizer = '.grid-sizer';
            }

            $container.imagesLoaded( function() {
                $container.masonry({
                    columnWidth: columnSizer,
                    itemSelector: '.grid-wrapper > figure, .grid-wrapper > .product',
                    transitionDuration: 0
                }).masonry('layout');
            });

             $(window).resize(function(){
                if(body.hasClass('.woocommerce.archive')){
                    if(x > 767){
                        columnSizer = 4;
                    }
                    else if(x < 768 && x >= 480){
                        columnSizer = 2;
                    }
                    else {
                        columnSizer = 1;
                    }
                }

                $container.masonry({
                    columnWidth: columnSizer
                });
            });
        }

        // SLIDERS

        var sliderCounter, counterElNumber;

        // Home slider

        var homeSlider = $('.home-slider ul');

        if(homeSlider.length){
            homeSlider.slick({
                slide: 'li',
                infinite: true,
                autoplay: true,
                autoplaySpeed: 4000,
                useTransform: true,
                pauseOnHover: true,
                speed: 500,
                centerMode: true,
                centerPadding: 0,
                fade: true,
                draggable: false,
                slidesToShow: 1,
                dots: true,
                cssEase: 'ease-out',
                responsive: [
                {
                  breakpoint: 1025,
                  settings: {
                    draggable: true
                  }
                }
              ]
            });

            sliderCounter = homeSlider.find('.slick-dots');
            counterElNumber = sliderCounter.find('li').length;
            sliderCounter.append('<span>'+counterElNumber+'</span>');
        }

        // Home Blog post slider

        var blogPostSlider = $('.home-blog-feed');

        if(blogPostSlider.length){

            var visiblePosts;
            var visiblePostsSmlScreens;

            if(blogPostSlider.hasClass('col-md-4')){
                visiblePosts = 1;
                visiblePostsSmlScreens = 1;
            }
            else if(blogPostSlider.hasClass('col-sm-12')){
                var slide = blogPostSlider.find('article');
                visiblePosts = 3;
                visiblePostsSmlScreens = 2;
                if(slide.length < 4 && x > 1024){
                    blogPostSlider.unslick();
                }
            }

            blogPostSlider.slick({
                slide: 'article',
                infinite: true,
                speed: 400,
                draggable: false,
                useTransform: true,
                slidesToShow: visiblePosts,
                adaptiveHeight: true,
                cssEase: 'ease-out',
                responsive: [
                {
                  breakpoint: 1201,
                  settings: {
                    slidesToShow: visiblePostsSmlScreens
                  }
                },
                {
                  breakpoint: 1025,
                  settings: {
                    arrows: true,
                    adaptiveHeight: true,
                    slidesToShow: 1,
                    draggable: true
                  }
                },
                {
                  breakpoint: 768,
                  settings: {
                    arrows: false,
                    adaptiveHeight: true,
                    slidesToShow: 1,
                    draggable: true,
                    dots: true
                  }
                }
              ]
            });

        }

	}); // End Window Load

    $(window).resize(function(){

        // Calculate clients viewport

        function viewport() {
            var e = window, a = 'inner';
            if(!('innerWidth' in window )) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
        }

        var w=window,d=document,
        e=d.documentElement,
        g=d.getElementsByTagName('body')[0],
        x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
        y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

        var body = $('body');

        // Main Header
        var mainHeader = $('#masthead');

        // Featured Slider

        if(body.hasClass('featured-slider-fullwidth')){
            var htmlOffsetTop = parseInt($('html').css('margin-top'));
            var featuredSlider = $('div.featured-slider');
            var featuredSliderHeight = featuredSlider.outerHeight();
            var headerHeight = mainHeader.outerHeight();

            var wScrollTop = $(window).scrollTop();

            if(x > 1024){

                $('.main-content-wrap').css({marginTop: (featuredSlider.outerHeight())});

                var featuredSliderDefaultHeader = function() {
                    if(wScrollTop > headerHeight - 4){
                        featuredSlider.css({opacity: ( featuredSliderHeight - wScrollTop + headerHeight ) / featuredSliderHeight});
                    }
                    else{
                        featuredSlider.css({opacity: 1});
                    }
                };
                featuredSliderDefaultHeader();

                $(window).scroll(function(){
                    wScrollTop = $(window).scrollTop();
                    featuredSliderDefaultHeader();
                });
            }
        }

        // Single post share

        var shareIconsWrap = $('.fullwidth-single .has-sidebar .sd-social-icon, .fullwidth-single .has-sidebar .tkss-post-share');

        if(shareIconsWrap.length){

            var shareIconsWrapWidth = shareIconsWrap.outerWidth();

            if(x > 1440){
                shareIconsWrap.parent().css({paddingLeft: shareIconsWrapWidth});
            }
            else{
                shareIconsWrap.parent().css({paddingLeft: ''});
            }

        }

	}); // End Window Resize

})(jQuery);