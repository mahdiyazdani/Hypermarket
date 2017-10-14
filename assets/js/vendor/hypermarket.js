/**
 * Hypermarket Theme
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.3.7
 */

jQuery(document).ready(function($) {
    'use strict';

    // Check if Page Scrollbar is visible
    //------------------------------------------------------------------------------
    var hasScrollbar = function() {
        // The Modern solution
        if (typeof window.innerWidth === 'number') {
            return window.innerWidth > document.documentElement.clientWidth;
        }

        // rootElem for quirksmode
        var rootElem = document.documentElement || document.body;

        // Check overflow style property on body for fauxscrollbars
        var overflowStyle;

        if (typeof rootElem.currentStyle !== 'undefined') {
            overflowStyle = rootElem.currentStyle.overflow;
        }

        overflowStyle = overflowStyle || window.getComputedStyle(rootElem, '').overflow;

        // Also need to check the Y axis overflow
        var overflowYStyle;

        if (typeof rootElem.currentStyle !== 'undefined') {
            overflowYStyle = rootElem.currentStyle.overflowY;
        }

        overflowYStyle = overflowYStyle || window.getComputedStyle(rootElem, '').overflowY;

        var contentOverflows = rootElem.scrollHeight > rootElem.clientHeight;
        var overflowShown = /^(visible|auto)$/.test(overflowStyle) || /^(visible|auto)$/.test(overflowYStyle);
        var alwaysShowScroll = overflowStyle === 'scroll' || overflowYStyle === 'scroll';

        return (contentOverflows && overflowShown) || (alwaysShowScroll);
    };
    if (hasScrollbar()) {
        $('body').addClass('hasScrollbar');
    }


    // Disable default link behavior for dummy links that have href='#'
    //------------------------------------------------------------------------------
    var $emptyLink = $('a[href=#]');
    $emptyLink.on('click', function(e) {
        e.preventDefault();
    });


    // Animated Scroll to Top Button
    //------------------------------------------------------------------------------
    var $scrollTop = $('.scroll-to-top-btn');
    if ($scrollTop.length > 0) {
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 600) {
                $scrollTop.addClass('visible');
            } else {
                $scrollTop.removeClass('visible');
            }
        });
        $scrollTop.on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('html').velocity('scroll', {
                offset: 0,
                duration: 1000,
                easing: 'easeOutExpo',
                mobileHA: false
            });
        });
    }


    // Smooth scroll to element
    //------------------------------------------------------------------------------
    var $scrollTo = $('.scroll-to');
    $scrollTo.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $commentID = '#',
            $elemOffsetTop = '',
            $targetElement = '';
        // Check if comment permalink clicked?
        if($(this).hasClass('comment-permalink')) {
            $commentID += $(this).data('comment-id');
            $elemOffsetTop = 0;
            $targetElement = $commentID;
        }else {
            $elemOffsetTop = $(this).data('offset-top');
            $targetElement = $(this.hash);
        }
        $($targetElement).velocity('scroll', {
            offset: $elemOffsetTop,
            duration: 1000,
            easing: 'easeOutExpo',
            mobileHA: false
        });
    });


    // Toggle Mobile Menu
    //------------------------------------------------------------------------------
    var menuToggle = $('.mobile-menu-toggle'),
        mobileMenu = $('.main-navigation, .mobile-menu-wrapper');
    menuToggle.on('click', function() {
        $(this).toggleClass('active');
        mobileMenu.toggleClass('open');
    });


    // Toggle Submenu
    //------------------------------------------------------------------------------
    var $hasSubmenu = $('.menu-item-has-children > a');

    function closeSubmenu() {
        $hasSubmenu.parent().removeClass('active');
    }
    $hasSubmenu.on('click', function(e) {
        if ($(e.target).parent().is('.active')) {
            closeSubmenu();
        } else {
            closeSubmenu();
            $(this).parent().addClass('active');
        }
    });


    // Sidebar Toggle on Mobile
    //------------------------------------------------------------------------------
    var sidebar = $('.sidebar'),
        sidebarToggle = $('.sidebar-toggle');
    sidebarToggle.on('click', function() {
        $(this).addClass('sidebar-open');
        sidebar.addClass('open');
    });
    $('.sidebar-close').on('click', function() {
        sidebarToggle.removeClass('sidebar-open');
        sidebar.removeClass('open');
    });


    // Count Input (Quantity)
    // Inspired by WooCommerce Quantity Increment Plugin
    //------------------------------------------------------------------------------
    if (!String.prototype.getDecimals) {
        String.prototype.getDecimals = function() {
            var num = this,
                match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            if (!match) {
                return 0;
            }
            return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        }
    }

    function HypermarketControlUpdateCartBtn() {
        if ($('body').hasClass('woocommerce-cart')) {
            $('.quantity .qty').live('change', function() {
                $('#update-cart-btn').removeAttr('disabled');
            });
            $('#update-cart-btn').live('click', function() {
                $('div.woocommerce > form input[name="update_cart"]').trigger('click');
            });
        }
    }

    $(document).on('updated_wc_div', function() {
        HypermarketControlUpdateCartBtn();
    });

    $(document).on('click', '.plus, .minus', function() {
        // Get values
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {
            if (max && (currentVal >= max)) {
                $qty.val(max);
            } else {
                $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
            }
        } else {
            if (min && (currentVal <= min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
            }
        }

        // Trigger change event
        $qty.trigger('change');
    });

    HypermarketControlUpdateCartBtn();


    // Country / state dropdown - Shipping
    //------------------------------------------------------------------------------
    $('#calc_shipping_country').live('change', function() {
        if ($('#calc_shipping_state').is('input') == true) {
            $('#calc_shipping_state_field').removeClass('form-select');
        } else {
            $('#calc_shipping_state_field').addClass('form-select');
        }
    });


    // Waves Effect (on Buttons)
    //------------------------------------------------------------------------------
    if ($('.waves-effect').length) {
        Waves.displayEffect({
            duration: 600
        });
    }


    // Add to Cart Button Effect
    //------------------------------------------------------------------------------
    hypermarketAddToCartEffect();


    // Product Gallery
    //------------------------------------------------------------------------------
    var galleryThumb = $('.product-gallery-thumblist a'),
        galleryPreview = $('.product-gallery-preview > li');


    // Thumbnails
    //------------------------------------------------------------------------------
    galleryThumb.on('click', function(e) {
        var target = $(this).attr('href');

        galleryThumb.parent().removeClass('active');
        $(this).parent().addClass('active');
        galleryPreview.removeClass('current');
        $(target).addClass('current');

        e.preventDefault();
    });
    // Back to first thumbnail on variation change.
    $('.variations select').click(function(){
        if($(this).val() !== '' && $('.product-gallery-thumblist li:first-child').hasClass('active') === false){
            $('.product-gallery-thumblist li:first-child a').trigger('click');
        }
    });

    // Maintain scorll position
    //------------------------------------------------------------------------------
    jQuery.fn.matchHeight._maintainScroll = true;


    // Tooltips
    //------------------------------------------------------------------------------
    hypermarketTooltipInitialization();


    // Setting background of sections
    //------------------------------------------------------------------------------
    $('.data-background').each(function() {
        if ($(this).attr('data-background')) {
            $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
        }
    });


    // Single product
    //------------------------------------------------------------------------------
    if ($('.single-product .entry-summary .woocommerce-product-rating').length > 0) {
        $('.entry-summary .product_meta').append($('.entry-summary .woocommerce-product-rating').get(0));
    }

    if ($('.single-product .product-tools table.variations').length > 0) {
        $('.entry-summary form .woocommerce-variation-add-to-cart .count-input').after($('.entry-summary .product-tools table.variations').get(0));
    }

    if ($('.single-product #commentform .form-submit').length > 0) {
        $('#commentform .form-submit').before($('#commentform .col-sm-12').get(0));
        $('#commentform .form-submit').addClass('space-bottom-none col-lg-3 col-md-4 col-sm-6 col-lg-offset-9 col-md-offset-8 col-sm-offset-6');
    }
    if ($('.single-product .woocommerce-tabs .reviews_tab > a').length > 0) {
        var reviewCount = $('.single-product .woocommerce-tabs .reviews_tab > a').text().trim().replace('(', '<sup>').replace(')', '</sup>');
        $('.single-product .woocommerce-tabs .reviews_tab > a').html(reviewCount);
    }
    


    // Order comments
    //------------------------------------------------------------------------------
    if ($('#order_comments').length > 0) {
        $('#order_comments').attr('rows', '8');
    }


    // Thank you page
    //------------------------------------------------------------------------------
    if ($('.woocommerce-order-received .woocommerce').length > 0) {
        $('.woocommerce-order-received .woocommerce').addClass('col-sm-12');
    }


    // Wrap iframe with responsive embed classes
    //------------------------------------------------------------------------------
    hypermarketMakeIframeResponsive();
    

    // Comment style (Single page,post,attachment)
    //------------------------------------------------------------------------------
    if ($('.single-post #comments .form-submit, .single-attachment #comments .form-submit, .type-page + #comments .form-submit').length > 0) {
        $('#comments .form-submit').before($('#comments .col-sm-12').get(0));
        $('#comments .form-submit').addClass('space-bottom-none col-lg-3 col-md-4 col-sm-6 col-lg-offset-9 col-md-offset-8 col-sm-offset-6');
    }
    
    // Compatibility with BS3 Grid Builder
    //------------------------------------------------------------------------------
    if ($('.bs3-grid-builder-container').closest('.col-sm-12').length > 0) {
        $('.bs3-grid-builder-container').unwrap('.col-sm-12');
    }
    //// Blog loop - BS3 Grid Builder
    ////------------------------------------------------------------------------------
    if ($('article.hypermarket-post-loop .bs3-grid-builder-container').length > 0) {
        $('article .bs3-grid-builder-container').removeClass('container');
        $('article .bs3-grid-builder-container').removeClass('container-fluid');
    }
    //// Single post - BS3 Grid Builder
    ////------------------------------------------------------------------------------
    if ($('.single-post article .bs3-grid-builder-container').length > 0) {
        $('article > hr, article .blog-post-meta, article .post-share').wrap('<div class="col-sm-12"></div>');
    }


}); /*Document Ready End*/

// Wrap iframe with responsive embed classes (Function)
//------------------------------------------------------------------------------
function hypermarketMakeIframeResponsive(selector) {
    if (typeof selector === "undefined" || selector === null) { 
        selector = '';
    }
    if (jQuery(selector + 'iframe').length > 0) {
        jQuery(selector + 'iframe').each(function() {
            if (jQuery(this).hasClass('wp-embedded-content')) {
                jQuery(this).wrap('<div class="center-block space-bottom"></div>');
                jQuery(this).attr('width', '100%');
            } else {
                jQuery(this).wrap('<div class="embed-responsive embed-responsive-16by9 space-bottom"></div>');
            }
        });
    }
}
// Tooltips (Function)
//------------------------------------------------------------------------------
function hypermarketTooltipInitialization(selector) {
    if (typeof selector === "undefined" || selector === null) { 
        selector = '';
    }
    var $tooltip = jQuery(selector + '[data-toggle="tooltip"]');
    if ($tooltip.length > 0) {
        $tooltip.tooltip();
    }
}
// Add to Cart Button Effect (Function)
//------------------------------------------------------------------------------
function hypermarketAddToCartEffect() {
    var animating = false;
    jQuery('.shop-item, .hero-product').each(function() {
        var addToCartBtn = jQuery(this).find('.add-to-cart:not(.product_type_variable)');
        addToCartBtn.on('click', function() {
            if (!animating) {
                //animate if not already animating
                animating = true;
                // resetCustomization(addToCartBtn);

                addToCartBtn.addClass('is-added').find('path').eq(0).animate({
                    //draw the check icon
                    'stroke-dashoffset': 0
                }, 300, function() {
                    setTimeout(function() {
                        // updateCart();
                        addToCartBtn.removeClass('is-added').find('em').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
                            //wait for the end of the transition to reset the check icon
                            addToCartBtn.find('path').eq(0).css('stroke-dashoffset', '19.79');
                            animating = false;
                        });

                        if (jQuery('.no-csstransitions').length > 0) {
                            // check if browser doesn't support css transitions
                            addToCartBtn.find('path').eq(0).css('stroke-dashoffset', '19.79');
                            animating = false;
                        }
                    }, 600);
                });
            }
            setTimeout(function(){
                hypermarketTooltipInitialization();
            }, 1000);
        });
    });
}