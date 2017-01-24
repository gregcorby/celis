(function($) { 'use strict';

	function retreive_font_weight( font_type ) {

		var font_selector = $( '#customize-control-' + font_type + '_font_family select' ),
			font_selected = font_selector.val(),
			weight_select;

		if ( 'default' != font_selected ) {

    		$.ajax({
	            type: 'POST',
	            url: js_vars.admin_url,
	            dataType: 'json',
	            data: {
	            	action: 'goodz_generate_font_weight',
	            	selected_font: font_selected
	            },
	            success: function( response ) {
	            	var result = eval( response ),
	            		select_options = '';

					for ( var index in result ) {

						var selected_variant            = '',
							headings_selected_variant   = js_vars.headings_font_variant,
							text_selected_variant       = js_vars.text_font_variant,
							navigation_selected_variant = js_vars.navigation_font_variant;

						switch ( font_type ) {
							case 'headings' :
								if ( index == headings_selected_variant ) {
									selected_variant = 'selected="selected"';
								}
								break;
							case 'paragraphs' :
								if ( index == text_selected_variant ) {
									selected_variant = 'selected="selected"';
								}
								break;
							case 'navigation' :
								if ( index == navigation_selected_variant ) {
									selected_variant = 'selected="selected"';
								}
								break;
							default :
								selected_variant = '';
						}

						select_options += '<option value="' + index + '" ' + selected_variant + '>' + result[index] + '</option>';
					}

					weight_select = $( '#customize-control-' + font_type + '_font_weight select' );
					weight_select.empty();
					weight_select.append( select_options );

	            }

	       	} );

       	} else {
       		weight_select = $( '#customize-control-' + font_type + '_font_weight select' );
       		weight_select.empty();
       		weight_select.append( '<option value="default">' + js_vars.default_text + '</option>' );
       	}

	}

    $(window).load(function(){

    	/**
    	 * On load set selected font family and weight
    	 */
    	retreive_font_weight( 'headings' );
		retreive_font_weight( 'paragraphs' );
		retreive_font_weight( 'navigation' );

    	/**
    	 * Select font and generate weight for it
    	 */
    	var headings_font_select   = $( '#customize-control-headings_font_family select' ),
	    	paragraphs_font_select = $( '#customize-control-paragraphs_font_family select' ),
	    	navigation_font_select = $( '#customize-control-navigation_font_family select' );

    	headings_font_select.on( 'change', function(){
    		retreive_font_weight( 'headings' );
    	} );

    	paragraphs_font_select.on( 'change', function(){
    		retreive_font_weight( 'paragraphs' );
    	} );

    	navigation_font_select.on( 'change', function(){
    		retreive_font_weight( 'navigation' );
    	} );

    	/**
    	 * Call To Action Boxes dependencies
    	 */
		var cta_layout_selected = $( '#customize-control-cta_layout_setting' ).find( 'select' );

		if ( 'three-thirds' != cta_layout_selected.val() ) {
			// Hide third box
			$( '[id^=customize-control-goodz_third_cta]' ).hide();
		}

		if ( 'fullwidth' == cta_layout_selected.val() ) {
			// Hide Second Box
			$( '[id^=customize-control-goodz_second_cta]' ).hide();
		}

		// On select layout remove options
		cta_layout_selected.on( 'change', function() {

			if ( 'three-thirds' == cta_layout_selected.val() ) {
				// Show Second Box
				$( '[id^=customize-control-goodz_second_cta]' ).show();

				// Show Third Box
				$( '[id^=customize-control-goodz_third_cta]' ).show();
			}
			else {
				// Hide Third Box
				$( '[id^=customize-control-goodz_third_cta]' ).hide();

				if ( 'fullwidth' == cta_layout_selected.val() ) {
					// Hide Second Box
					$( '[id^=customize-control-goodz_second_cta]' ).hide();
				}
				else {
					// Show Second Box
					$( '[id^=customize-control-goodz_second_cta]' ).show();
				}
			}

		} );

    	/**
    	 * Layout dependencies
    	 *
    	 * Don't display options if masonry layout type is selected
    	 */
    	var layout_selected = $( "#customize-control-layout_type_setting" ).find( 'select' );

    	if ( 'masonry' == layout_selected.val() ) {
			$( "#customize-control-product_columns_setting" ).hide();
			$( "#customize-control-product_display_setting" ).hide();
			$( "#customize-control-shop_sidebar_setting" ).hide();
			$( "#customize-control-product_display_qv" ).hide();
		}

    	// On select layout remove options
		layout_selected.on( 'change', function() {
			if ( 'masonry' == layout_selected.val() ) {
				$( "#customize-control-product_columns_setting" ).hide();
				$( "#customize-control-product_display_setting" ).hide();
				$( "#customize-control-shop_sidebar_setting" ).hide();
				$( "#customize-control-product_display_qv" ).hide();
			}
			else {
				$( "#customize-control-product_columns_setting" ).show();
				$( "#customize-control-product_display_setting" ).show();
				$( "#customize-control-shop_sidebar_setting" ).show();
				$( "#customize-control-product_display_qv" ).show();
			}
		} );

    	/**
    	 * Sidebar Dependencies
    	 *
    	 * Don't display 5 or 6 columns option if sidebar is selected
    	 */

		// Customizer settings display
		var select_sidebar = $( "#customize-control-shop_sidebar_setting" ).find( 'select' );

		// Columns selector
		var columns_select = $( '#customize-control-product_columns_setting' ).find( 'select' );
		var sidebar_value  = select_sidebar.val();
		var columns_5      = columns_select.find( "option[value='col-sm-tk-5']" );
		var columns_6      = columns_select.find( "option[value='col-sm-2']" );

		if ( sidebar_value == 'sidebar-left' || sidebar_value == 'sidebar-right' ) {

			if ( columns_select.val() == 'col-sm-tk-5' || columns_select.val() == 'col-sm-2' ) {
					columns_select.val( 'col-sm-3' ).change();
			}

			columns_5.remove();
			columns_6.remove();
		}

		// On select layout remove options
		select_sidebar.on( 'change', function(){
			sidebar_value = $(this).val();
			var columns_5 = columns_select.find( "option[value='col-sm-tk-5']" );
			var columns_6 = columns_select.find( "option[value='col-sm-2']" );

			if ( sidebar_value == 'sidebar-left' || sidebar_value == 'sidebar-right' ) {

				if ( columns_select.val() == 'col-sm-tk-5' || columns_select.val() == 'col-sm-2' ) {
					columns_select.val( 'col-sm-3' ).change();
				}

				columns_5.remove();
				columns_6.remove();
			}
			else {
				columns_select.append( '<option value="col-sm-tk-5">5</option>' );
				columns_select.append( '<option value="col-sm-2">6</option>' );
			}
		} );

    } ); // End Document Ready

} )(jQuery);
