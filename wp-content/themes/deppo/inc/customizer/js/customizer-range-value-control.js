/**
 * Script run inside a Customizer control sidebar
 */
(function($) {
    wp.customize.bind('ready', function() {
        rangeSlider();

        $( window ).load( function() {
            if ( false == wp.customize.control( 'custom_logo' ).setting() ) {
                // wp.customize.control( 'logo_size' ).deactivate();
                $( '#customize-control-logo-size' ).hide();
            }
        } );
    });

    var rangeSlider = function() {
        var slider = $('.range-slider'),
            range = $('.range-slider__range'),
            value = $('.range-slider__value');

        slider.each(function() {

            value.each(function() {
                var value = $(this).prev().attr('value');
				var suffix = ($(this).prev().attr('suffix')) ? $(this).prev().attr('suffix') : '';
                $(this).html(value + suffix);
            });

            range.on('input', function() {
				var suffix = ($(this).attr('suffix')) ? $(this).attr('suffix') : '';
                $(this).next(value).html(this.value + suffix );
            });
        });
    };

    // Check logo changes
    wp.customize( 'custom_logo', function ( value ){
        value.bind ( function ( to ) {
            if ( '' === to ) {
                wp.customize.control( 'logo-size' ).deactivate();
            } else {
                $( '#customize-control-logo-size' ).show();
                wp.customize.control( 'logo-size' ).activate();
                wp.customize.control( 'logo-size' ).setting( 100 );
                wp.customize.control( 'logo-size' ).setting.preview();
            }
        } );
    } );

})(jQuery);
