/**
 * WooCommerce specific js functions
 */
(function($) { 'use strict';

    /**
     * YITH Wishlist functions
     */

    // Check if cookies are enabled
    function is_cookie_enabled() {
        if (navigator.cookieEnabled) return true;

        // set and read cookie
        document.cookie = "cookietest=1";
        var ret = document.cookie.indexOf("cookietest=") != -1;

        // delete cookie
        document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";

        return ret;
    }

    // Add to wishlist AJAX
    function call_ajax_add_to_wishlist( el ) {

        var product_id = el.data( 'product-id' ),
            el_wrap = $( '.add-to-wishlist-' + product_id ),
            data = {
                add_to_wishlist: product_id,
                product_type: el.data( 'product-type' ),
                action: yith_wcwl_l10n.actions.add_to_wishlist_action
            };

        if( yith_wcwl_l10n.multi_wishlist && yith_wcwl_l10n.is_user_logged_in ){
            var wishlist_popup_container = el.parents( '.yith-wcwl-popup-footer' ).prev( '.yith-wcwl-popup-content' ),
                wishlist_popup_select = wishlist_popup_container.find( '.wishlist-select' ),
                wishlist_popup_name = wishlist_popup_container.find( '.wishlist-name' ),
                wishlist_popup_visibility = wishlist_popup_container.find( '.wishlist-visibility' );

            data.wishlist_id = wishlist_popup_select.val();
            data.wishlist_name = wishlist_popup_name.val();
            data.wishlist_visibility = wishlist_popup_visibility.val();
        }

        if( ! is_cookie_enabled() ){
            alert( yith_wcwl_l10n.labels.cookie_disabled );
            return;
        }

        $.ajax({
            type: 'POST',
            url: yith_wcwl_l10n.ajax_url,
            data: data,
            dataType: 'json',
            beforeSend: function(){
                el.siblings( '.ajax-loading' ).css( 'visibility', 'visible' );
            },
            complete: function(){
                el.siblings( '.ajax-loading' ).css( 'visibility', 'hidden' );
            },
            success: function( response ) {
                var msg = $( '#yith-wcwl-popup-message' ),
                    response_result = response.result,
                    response_message = response.message;

                if( yith_wcwl_l10n.multi_wishlist && yith_wcwl_l10n.is_user_logged_in ) {
                    var wishlist_select = $( 'select.wishlist-select' );
                    if( typeof $.prettyPhoto != 'undefined' ) {
                        $.prettyPhoto.close();
                    }

                    wishlist_select.each( function( index ){
                        var t = $(this),
                            wishlist_options = t.find( 'option' );

                        wishlist_options = wishlist_options.slice( 1, wishlist_options.length - 1 );
                        wishlist_options.remove();

                        if( typeof( response.user_wishlists ) != 'undefined' ){
                            var i = 0;
                            for( i in response.user_wishlists ) {
                                if ( response.user_wishlists[i].is_default != "1" ) {
                                    $('<option>')
                                        .val(response.user_wishlists[i].ID)
                                        .html(response.user_wishlists[i].wishlist_name)
                                        .insertBefore(t.find('option:last-child'))
                                }
                            }
                        }
                    } );
                }

                $( '#yith-wcwl-message' ).html( response_message );
                msg.css( 'margin-left', '-' + $( msg ).width() + 'px' ).fadeIn();
                window.setTimeout( function() {
                    msg.fadeOut();
                }, 2000 );

                if( response_result == "true" ) {
                    if( ! yith_wcwl_l10n.multi_wishlist || ! yith_wcwl_l10n.is_user_logged_in || ( yith_wcwl_l10n.multi_wishlist && yith_wcwl_l10n.is_user_logged_in && yith_wcwl_l10n.hide_add_button ) ) {
                        el_wrap.find('.yith-wcwl-add-button').hide().removeClass('show').addClass('hide');
                    }

                    el_wrap.find( '.yith-wcwl-wishlistexistsbrowse').hide().removeClass('show').addClass('hide').find('a').attr('href', response.wishlist_url);
                    el_wrap.find( '.yith-wcwl-wishlistaddedbrowse' ).show().removeClass('hide').addClass('show').find('a').attr('href', response.wishlist_url);
                } else if( response_result == "exists" ) {
                    if( ! yith_wcwl_l10n.multi_wishlist || ! yith_wcwl_l10n.is_user_logged_in || ( yith_wcwl_l10n.multi_wishlist && yith_wcwl_l10n.is_user_logged_in && yith_wcwl_l10n.hide_add_button ) ) {
                        el_wrap.find('.yith-wcwl-add-button').hide().removeClass('show').addClass('hide');
                    }

                    el_wrap.find( '.yith-wcwl-wishlistexistsbrowse' ).show().removeClass('hide').addClass('show').find('a').attr('href', response.wishlist_url);
                    el_wrap.find( '.yith-wcwl-wishlistaddedbrowse' ).hide().removeClass('show').addClass('hide').find('a').attr('href', response.wishlist_url);
                } else {
                    el_wrap.find( '.yith-wcwl-add-button' ).show().removeClass('hide').addClass('show');
                    el_wrap.find( '.yith-wcwl-wishlistexistsbrowse' ).hide().removeClass('show').addClass('hide');
                    el_wrap.find( '.yith-wcwl-wishlistaddedbrowse' ).hide().removeClass('show').addClass('hide');
                }

                $('body').trigger('added_to_wishlist');
            }

        });
    }

    /**
     * DOM Ready functions
     */
    $(document).ready(function($){

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

        // Global vars
    	var $window = $(window);
        var body = $('body');
        var wScrollTop = $window.scrollTop();
        var sidebar = $('#secondary');
        var mainHeader = $('#masthead');

        // Shop grid switcher

        if (body.hasClass('woocommerce') && body.hasClass('archive') && !body.hasClass('shop-masonry') && sidebar.length < 1){
            var lessGrid = $('#less-grid');
            var moreGrid = $('#more-grid');
            var product = $('.product[class*="col-"]');
            var productClassString = product.attr('class');
            var productInitialGridClass = (productClassString.match(/(^|\s)col-\S+/g) || []);

            if(product.hasClass('col-sm-2') || product.hasClass('col-sm-tk-5')){
                lessGrid.on('click', function(){
                    $(this).addClass('active').siblings('figure').removeClass('active');
                    if (!product.hasClass('col-sm-3')){
                        product.removeClass(function (index, css) {
                            return (css.match(/(^|\s)col-\S+/g) || []).join('');
                        }).addClass('col-sm-3');
                    }
                });

                moreGrid.addClass('active').on('click', function(){
                    $(this).addClass('active').siblings('figure').removeClass('active');
                    if (!product.hasClass(productInitialGridClass)){
                        product.removeClass('col-sm-3').addClass(''+productInitialGridClass+'');
                    }
                });
            }

            if(product.hasClass('col-sm-3') || product.hasClass('col-sm-4')){
                lessGrid.addClass('active').on('click', function(){
                    $(this).addClass('active').siblings('figure').removeClass('active');
                    if (!product.hasClass(productInitialGridClass)){
                        product.removeClass('col-sm-2').addClass(''+productInitialGridClass+'');
                    }
                });

                moreGrid.on('click', function(){
                    $(this).addClass('active').siblings('figure').removeClass('active');
                    if (!product.hasClass('col-sm-2')){
                        product.removeClass(function (index, css) {
                            return (css.match(/(^|\s)col-\S+/g) || []).join('');
                        }).addClass('col-sm-2');
                    }
                });
            }

            if(product.hasClass('col-sm-6')){
                lessGrid.addClass('active').on('click', function(){
                    $(this).addClass('active').siblings('figure').removeClass('active');
                    if (!product.hasClass(productInitialGridClass)){
                        product.removeClass('col-sm-tk-5').addClass(''+productInitialGridClass+'');
                    }
                });

                moreGrid.on('click', function(){
                    $(this).addClass('active').siblings('figure').removeClass('active');
                    if (!product.hasClass('col-sm-tk-5')){
                        product.removeClass(function (index, css) {
                            return (css.match(/(^|\s)col-\S+/g) || []).join('');
                        }).addClass('col-sm-tk-5');
                    }
                });
            }

        }

        if(body.hasClass('woocommerce') && body.hasClass('archive') && !body.hasClass('shop-masonry') && sidebar.length > 0){
            var gridSwitcher = $('#less-grid, #more-grid');
            gridSwitcher.addClass('hide');
        }

        // Single product share


        if(body.hasClass('single-product') && x <= 1024){

            var productShareTrigger = $('.product-share-wrap > span');

            productShareTrigger.on('click', function(){
                $(this).siblings('.product-share-box').toggleClass('active');
            });

        }

    	// Quick View Modal

        $window.on('click', function(){
            productModalWrap.hide();
            if ( $( '.modal-container' ).length ) {
                $( '.modal-container' ).remove();
            }
        });

        var productModalWrap  = $('div.product-modal-wrapp');
        var productModal      = productModalWrap.find('.product-modal');
        var closeProductModal = productModalWrap.find('.close');

        if(x > 1024){
            var quickViewTrig = $('span.quick-view-trigger');

            quickViewTrig.on('click', function(e){
                e.preventDefault();

                var product_id = $(this).data('pid');

                $.ajax({
                    type: "post",
                    url: woo_vars.admin_url,
                    data:{
                        action: 'woo_quickview_modal',
                        nonce: woo_vars.nonce,
                        productid: product_id
                    },
                    success: function(data){

                        // var wishList = ;

                        productModal.prepend(data);

                        // Replace Add To Cart Form
                        var modal_form      = $('.product-modal form.cart');
                        modal_form.addClass('modal-form');

                        var add_to_cart     = $('.modal-form');
                        var product_summary = $('.product-modal .entry-summary');

                        // add_to_cart.remove();
                        product_summary.append( add_to_cart );

                        $('.yith-wcwl-add-to-wishlist').insertAfter(add_to_cart);

                        productModalWrap.show();

                        $.getScript( woo_vars.woo_js );
                        $.getScript( woo_vars.woo_add_to_cart );

                        $('.add_to_wishlist').on('click', function(ev){

                            ev.preventDefault();

                            var t = $( this );

                            call_ajax_add_to_wishlist( t );

                            return false;
                        });

                        // Product img slider

                        var productModalSlider = productModal.find('.images');

                        if(productModalSlider.find('img').length > 1){

                            productModalSlider.slick({
                                slide: 'figure',
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                speed: 400,
                                useTransform: true,
                                arrows: false,
                                dots: true,
                                customPaging: function(slick,index) {
                                    return slick.$slides.eq(index).find('img').prop('outerHTML');
                                },
                                draggable: false,
                                initialSlide: 0,
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
                        }

                        // Custom number field

                        var numInput = productModalWrap.find('input.input-text.qty');

                        numInput.parent('.quantity').append('<a id="up" href="#">+</a><a id="down" href="#">-</a>');
                        var adjustVal = numInput.siblings('a');

                        adjustVal.on('click', function(e){
                            var minVal = parseInt(numInput.attr('min'));
                            var maxVal = parseInt(numInput.attr('max'));
                            e.preventDefault();
                            var $this = $(this);
                            var value = parseInt(numInput.val());
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
                            numInput.val(value);
                        });

                        var productModalHeight = productModal.outerHeight();

                        productModal.css({marginTop: -(productModalHeight / 2)});

                    }
                });
                return false;

            });
        }

        closeProductModal.on('click', function(e){
            e.preventDefault();
            e.stopPropagation();
            productModalWrap.hide();

            if ( $( '.modal-container' ).length ) {
                $( '.modal-container' ).remove();
            }

        });

        productModal.on('click', function(e){
            e.stopPropagation();
        });

        // Disable cart tooltip if cart empty
        var prodCounter = parseInt( $( '.cart-contents .count' ).html() );

        if ( 0 == prodCounter ) {
            $( '.cart-widget__container' ).remove();
        }

    	// Ajax remove from cart

		$(document).on('click', '.mini_cart_item .remove', function(e) {

			e.preventDefault();
			e.stopPropagation();

			var prod_id  = $(this).data('product_id'),
                cartcounter,
				var_id = $(this).data('variation_id'),
				prod_quantity = $(this).data('product_qty'),
				data = {
					action: 'goodz_cart_product_remove',
					product_id: prod_id,
					variation_id: var_id
				},
				ajaxURL = woo_vars.admin_url;

			$.post(ajaxURL, data, function(response) {
				var product_remove;

				if ( var_id > 0 ) {
					product_remove = $('.mini_cart_item').find("[data-variation_id='" + var_id + "']");
				} else {
					product_remove = $('.mini_cart_item').find("[data-product_id='" + prod_id + "']");
				}

				// Remove product from mini cart
				product_remove.parent().fadeOut(100);
                prodCounter = parseInt( $( '.cart-contents .count' ).html() );
				cartcounter = prodCounter - prod_quantity;

				$('.cart-contents > .count').empty().append(cartcounter);
				$('.cart-contents').find('.amount').empty().append(response);
				$('.widget_shopping_cart_content > .total').find('.amount').empty().append(response);

				if( 0 == cartcounter ){
                    $('.widget_shopping_cart_content > .total').empty();
                    $('.widget_shopping_cart_content > .total').append( woo_vars.woo_no_items_cart );
                    $('.widget_shopping_cart_content > .buttons').remove();
                    $( '.cart-widget__container' ).hide();
				}

			});

			return false;

		});

        // Infinite scroll for products

        var wooGridItem = $('.products .row .product');

        wooGridItem.each(function(i){
             setTimeout(function(){
                 wooGridItem.eq(i).addClass('post-loaded animate');
             }, 200 * (i+1));
        });

        var $wooContainer = $('.products .row');
        var wooLoadingImg    = woo_vars.url + '/img/spinner.gif';
        var wooNo_more_posts = woo_vars.no_more_text;

        var loadNumber = 1;

        $wooContainer.infinitescroll({
            navSelector  : '#infinite-handle',    // selector for the paged navigation
            nextSelector : '#infinite-handle .nav-previous a',  // selector for the NEXT link (to page 2)
            itemSelector : 'div.product',
            loading: {
                finishedMsg: wooNo_more_posts,
                msgText: '',
                img: wooLoadingImg,
                selector: '#loading-is'
            }
        },
        function() {

            // Reactivate masonry on post load

            var newEl = $wooContainer.children().not('div.post-loaded, span.infinite-loader').addClass('post-loaded');

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
            var max = parseInt( woo_vars.maxPages );
            loadNumber++;

            if ( woo_vars.woo_is_type == 'click' && loadNumber < max ) {
                // Display Load More button
                $('#infinite-handle').show();
            }

        });

        // If Infinite Scroll on click is choosen
        if ( 'infinite_scroll' == woo_vars.woo_paging_type && woo_vars.woo_is_type == 'click' ) {

            //Onclick InfiniteScroll
            $(window).unbind('.infscr');

            $("#infinite-handle .nav-previous a").click(function(e){
                e.preventDefault();

                $wooContainer.infinitescroll('retrieve');
                return false;
            });

        }

        // Remove button for woo messages

        if(body.is('[class*="woocommerce"]')){
            var removeWooMsg = function(){
                var removeMsg = $('i.woo-msg-close');

                removeMsg.on('click', function(){
                    $(this).parent().fadeOut(300);
                });
            };

            removeWooMsg();
        }

        // Wishlist empty

        if(body.hasClass('woocommerce-wishlist') && $('.wishlist_table td').hasClass('wishlist-empty')){
            $('.wishlist-title, .wishlist_table thead').hide();
        }

    });

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

        // Global vars
        var $window = $(window);
        var body = $('body');
        var mainHeader = $('#masthead');
        var w=window,d=document,

        e=d.documentElement,
        g=d.getElementsByTagName('body')[0],
        x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
        y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

        var body = $('body');

        if(body.hasClass('woocommerce-account') && x > 1024){

            var accountDetails = $('.account-details-wrap');
            var accountAddresses = $('.account-details-wrap + .addresses-wrap');
            var accountDetailsHeight = accountDetails.outerHeight();
            var accountAddressesHeight = accountAddresses.outerHeight();

            if(accountDetailsHeight < accountAddressesHeight){
                accountDetails.css({minHeight: accountAddressesHeight});
            }
            else{
                accountAddresses.css({bottom: 0});
            }
        }

        // SLIDERS

        var sliderCounter, counterElNumber;

        // Home shop items

        var homeShopItems = $('.home-shop-items');

        if(homeShopItems.length){

            homeShopItems.find('.slider').slick({
                slide: '.product',
                infinite: true,
                speed: 400,
                draggable: false,
                arrows: true,
                useTransform: true,
                adaptiveHeight: true,
                slidesToShow: 5,
                cssEase: 'ease-out',
                responsive: [
                {
                  breakpoint: 1280,
                  settings: {
                    slidesToShow: 3,
                  }
                },
                {
                  breakpoint: 1025,
                  settings: {
                    draggable: true,
                    slidesToShow: 2
                  }
                },
                {
                  breakpoint: 768,
                  settings: {
                    arrows: false,
                    dots: true,
                    draggable: true,
                    slidesToShow: 1,
                    adaptiveHeight: false
                  }
                }
              ]
            });
        }

        // Single product slider

        var singleProductSlider = $('.fullwidth .product .images-wrap');

        if(singleProductSlider.find('img').length){

            var headerHeight = mainHeader.outerHeight();
            var siteContentPaddingTop = parseInt($('#content').css('padding-top'));
            var sliderMarginBottom = parseInt($('.images').css('margin-bottom'));
            var htmlOffsetTop = parseInt($('html').css('margin-top'));

            if(x > 991){
                singleProductSlider.height(y - headerHeight - htmlOffsetTop - siteContentPaddingTop - sliderMarginBottom);
            }
            else{
                singleProductSlider.height();
            }

            singleProductSlider.slick({
                slide: 'a',
                dots: true,
                infinite: true,
                speed: 400,
                useTransform: true,
                centerMode: true,
                centerPadding: 0,
                draggable: false,
                fade: true,
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
                    arrows: false,
                    draggable: true,
                  }
                }
              ]
            });

            sliderCounter = singleProductSlider.find('.slick-dots');
            counterElNumber = sliderCounter.find('li').length;
            sliderCounter.append('<span>'+counterElNumber+'</span>');
        }

        // Add layout class to Cross sells and Upsells

        var crossUpSells = $('.upsells, .cross-sells');

        if(crossUpSells.length){
            crossUpSells.find('.product').removeClass('col-sm-3').addClass('col-sm-tk-5');
        }

    });

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

        // Single product slider

        var singleProductSlider = $('.fullwidth .product .images-wrap');

        if(singleProductSlider.find('img').length){

            var mainHeader = $('#masthead');
            var headerHeight = mainHeader.outerHeight();
            var siteContentPaddingTop = parseInt($('#content').css('padding-top'));
            var sliderMarginBottom = parseInt($('.images').css('margin-bottom'));
            var htmlOffsetTop = parseInt($('html').css('margin-top'));

            if(x > 991){
                singleProductSlider.height(y - headerHeight - htmlOffsetTop - siteContentPaddingTop - sliderMarginBottom);
            }
            else{
                singleProductSlider.height('');
            }
        }

    }); // End Window Resize

})(jQuery);
