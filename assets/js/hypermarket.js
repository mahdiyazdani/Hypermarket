/**
 * Hypermarket Theme
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.3
 */
;
(function() {
    window.onload = function() {
        var preloading = document.querySelector('.page-preloading');
        preloading.classList.add('loading-done');
    };
})();

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

    // Page Transitions
    if($('.page-preloading').length) {
        $('a:not([href^="#"])').on('click', function(e) {
        if( $(this).hasClass('gallery-item') === false && 
            $(this).hasClass('ajax-post-link') === false && 
            $(this).hasClass('read-more ajax-post-link') === false && 
            $(this).hasClass('ajax_add_to_cart') === false && 
            $(this).hasClass('comment-reply-link') === false && 
            $(this).is('#cancel-comment-reply-link') === false && 
            $(this).hasClass('hypermarket-sl-button') === false && 
            $(this).hasClass('hypermarket-share-icon') === false &&
            $(this).attr('target') !== '_blank') {
          e.preventDefault();
          var linkUrl = $(this).attr('href');
          $('.page-preloading').addClass('link-clicked');
          setTimeout(function(){
            $('.page-preloading').removeClass('link-clicked');
            window.open(linkUrl , '_self');
          }, 550);
        }
      });
    }


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
            $('html').velocity("scroll", {
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
    $scrollTo.on('click', function(event) {
        var $elemOffsetTop = $(this).data('offset-top');
        $('html').velocity("scroll", {
            offset: $(this.hash).offset().top - $elemOffsetTop,
            duration: 1000,
            easing: 'easeOutExpo',
            mobileHA: false
        });
        event.preventDefault();
    });


    // Toggle Mobile Menu
    //------------------------------------------------------------------------------
    var menuToggle = $('.mobile-menu-toggle'),
        mobileMenu = $('.main-navigation');
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
    var animating = false;
    $('.shop-item').each(function() {
        var addToCartBtn = $(this).find('.add-to-cart:not(.product_type_variable)');
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

                        if ($('.no-csstransitions').length > 0) {
                            // check if browser doesn't support css transitions
                            addToCartBtn.find('path').eq(0).css('stroke-dashoffset', '19.79');
                            animating = false;
                        }
                    }, 600);
                });
            }
        });
    });


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


    // Tooltips
    //------------------------------------------------------------------------------
    hypermarketTooltipInitialization();


    // Setting background of sections
    //------------------------------------------------------------------------------
    $('div.data-background').each(function() {
        if ($(this).attr('data-background')) {
            $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
        }
    });


    // Add custom badge to best seller products.
    //------------------------------------------------------------------------------
    function hypermarketBestSellerBadge() {
        if($('#hypermarket-best-sellers-products').length > 0) {
            $('#hypermarket-best-sellers-products .shop-item .shop-thumbnail').each(function(){
                if($(this).find('span.onsale').length > 0){
                    $(this).find('span.onsale').remove();
                }
                $(this).prepend('<span class="shop-label text-warning">' + hypermarket_vars.popular + '</span>');
            });
        }
    }
    hypermarketBestSellerBadge();


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


    // Simple post like
    // A simple and efficient post like system for WordPress.
    // @link: https://github.com/JonMasterson/WordPress-Post-Like-System
    //------------------------------------------------------------------------------
    $(document).on('click', '.hypermarket-sl-button', function() {
        var button = $(this),
            post_id = button.attr('data-post-id'),
            security = button.attr('data-nonce'),
            iscomment = button.attr('data-iscomment'),
            allbuttons;
        if (iscomment === '1') { /* Comments can have same id */
            allbuttons = $('.hypermarket-sl-comment-button-' + post_id);
        } else {
            allbuttons = $('.hypermarket-sl-button-' + post_id);
        }
        var loader = allbuttons.next('.hypermarket-sl-loader');
        if (post_id !== '') {
            $.ajaxSetup({cache:true});
            $.ajax({
                type: 'POST',
                url: hypermarket_vars.ajaxurl,
                timeout: 10000,
                async: true,
                cache: true,
                data: {
                    action: 'hypermarket_process_simple_like',
                    post_id: post_id,
                    nonce: security,
                    is_comment: iscomment,
                },
                beforeSend: function() {
                    loader.html('&nbsp;<span class="loader"><small><em>' + hypermarket_vars.loading + '</em></small></span>');
                },
                success: function(response) {
                    var icon = response.icon;
                    var count = response.count;
                    allbuttons.html(icon + count);
                    if (response.status === 'unliked') {
                        var like_text = hypermarket_vars.like;
                        allbuttons.prop('title', like_text);
                        allbuttons.removeClass('liked');
                    } else {
                        var unlike_text = hypermarket_vars.unlike;
                        allbuttons.prop('title', unlike_text);
                        allbuttons.addClass('liked');
                    }
                    loader.empty();
                }
            });

        }
        return false;
    });


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