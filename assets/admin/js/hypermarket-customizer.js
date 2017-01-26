/**
 * Hypermarket Customizer
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.1
 */
(function($) {
    $(function() {
    	// Add Upsell Message
		if ('undefined' !== typeof hypermarket_upsell) {
			var upsell = $('<a class="hypermarket-upsell-link"></a>')
				.attr('href', hypermarket_upsell.upsellURL)
				.attr('target', '_blank')
				.text(hypermarket_upsell.upsellLabel)
				.css({
					'display' : 'block',
					'background-color' : '#2EA2CC',
					'color' : '#fff',
					'text-transform' : 'uppercase',
					'margin-top' : '6px',
					'padding' : '5px 0 5px 15px',
					'font-size': '11px',
					'letter-spacing': '1px',
					'line-height': '1.5',
					'clear' : 'both',
					'box-shadow' : 'none',
					'outline' : 'none',
					'top' : '-15px',
					'position' : 'relative',
					'text-decoration' : 'none'
				})
			;
			setTimeout(function () {
				$('#accordion-section-themes').append(upsell);
			}, 200);
			// Remove accordion click event
			$('.hypermarket-upsell-link').on('click', function(e) {
				e.stopPropagation();
			});
		}
		// Add BS3 Grid Builder Message
		if ('undefined' !== typeof hypermarket_bs3_grid_builder) {
			var bs3_grid_builder = $('<a class="get-bs3-grid-builder"></a>')
				.attr('href', hypermarket_bs3_grid_builder.bs3GridBuilderURL)
				.attr('target', '_blank')
				.text(hypermarket_bs3_grid_builder.bs3GridBuilderLabel)
				.css({
					'display' : 'inline-block',
                    'position' : 'relative',
                    'padding' : '3px 6px',
                    'line-height' : '1.5',
                    'font-size' : '9px',
                    'letter-spacing' : '1px',
                    'text-transform' : 'uppercase',
                    '-webkit-font-smoothing' : 'subpixel-antialiased',
                    'color' : '#cdbfe3',
                    'text-align' : 'center',
                    'box-shadow' : 'none',
                    'clear' : 'both',
                    'text-decoration' : 'none',
                    'text-shadow' : '0 1px 0 rgba(0, 0, 0, .1)',
                    'background-color' : '#6f5499',
                    'background-image' : '-webkit-gradient(linear, left top, left bottom, from(#563d7c), to(#6f5499))',
                    'background-image' : '-webkit-linear-gradient(top, #563d7c 0, #6f5499 100%)',
                    'background-image' : '-o-linear-gradient(top, #563d7c 0, #6f5499 100%)',
                    'background-image' : 'linear-gradient(to bottom, #563d7c 0, #6f5499 100%)',
                    'filter' : 'progid: DXImageTransform.Microsoft.gradient(startColorstr=\'#563d7c\', endColorstr=\'#6F5499\', GradientType=0)',
                    'background-repeat' : 'repeat-x'
				})
			;
			setTimeout(function () {
				$('#accordion-section-themes .accordion-section-title .change-theme').after(bs3_grid_builder);
			}, 200);
			// Remove accordion click event
			$('.get-bs3-grid-builder').on('click', function(e) {
				e.stopPropagation();
			});
		}
    }); // end of document ready
})(jQuery); // end of jQuery name space