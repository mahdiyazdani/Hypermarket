/**
 * Hypermarket Theme
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.2
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

    // Single Post via Ajax
    //------------------------------------------------------------------------------
    var hypermarketAjaxPost = $('#hypermarket-ajax-post'),
            ajaxPostLink = $('.ajax-post-link'),
            postBackdrop = $('.single-post-backdrop'),
            postContainer = $('.single-post-wrap'),
            postContentWrap = $('.single-post-wrap .inner'),
            postContent = $('.single-post-wrap .inner .post-content'),
            closeBtn = $('.single-post-wrap .close-btn'),
            postPreloader = $('.single-post-wrap .preloader');
    if (hypermarketAjaxPost.length > 0) {
        // Get Data via Ajax
        function getData(postID) {
            $.ajaxSetup({cache:true});
            $.ajax({
                type: 'POST',
                url: hypermarket_vars.ajaxurl,
                dataType: 'html',
                timeout: 10000,
                async: true,
                cache: true,
                data: ({
                    post_id: postID,
                    action: 'hypermarket_get_ajax_post_content',
                    security: hypermarket_vars.security
                }),
                success: successFn,
                error: errorFn,
                complete: function(xhr, status) {
                    console.log('Request is complete!');
                }
            });
        }

        // Success
        function successFn(result, status) {
            postContent.prepend(result);
            hypermarketTooltipInitialization('#hypermarket-ajax-post ');
            hypermarketMakeIframeResponsive('#hypermarket-ajax-post ');
            // Compatibility with BS3 Grid Builder
            $('#hypermarket-ajax-post article .bs3-grid-builder-container').removeClass('container');
            $('#hypermarket-ajax-post article .bs3-grid-builder-container').removeClass('container-fluid');
            postContentWrap.addClass('loaded');
        }

        // Error
        function errorFn(xhr, status, strErr) {
            postContent.prepend('<p>' + strErr + '</p>');
            postContentWrap.addClass('loaded');
        }

        // Open Post
        function openPost(postID) {
            $('body').addClass('blog-post-open');
            postBackdrop.addClass('active');
            postContainer.addClass('open');
            postPreloader.addClass('active');
            getData(postID);
            setTimeout(function() {
                postPreloader.removeClass('active');
            }, 1000);
        }

        // Close Post
        function closePost() {
            $('body').removeClass('blog-post-open');
            postBackdrop.removeClass('active');
            postContainer.removeClass('open');
            postContentWrap.removeClass('loaded');
            setTimeout(function() {
                postContent.empty();
            }, 500);
        }

        ajaxPostLink.on('click', function(e) {
            var targetPost = $(this).data('postid');
            openPost(targetPost);
            e.preventDefault();
        });

        closeBtn.on('click', closePost);
    }

    // Hero Slider
    //------------------------------------------------------------------------------
    var heroSlider = $('.hero-slider .inner');
    if (heroSlider.length > 0) {
        heroSlider.each(function() {
            var loop = ($(this).parent().data('loop') === 1) ? true : false,
                autoplay = ($(this).parent().data('autoplay') === 1) ? true : false,
                interval = $(this).parent().data('interval') || 3000,
                nav = ($(this).parent().data('nav') === 1) ? true : false,
                dots = ($(this).parent().data('dots') === 1) ? true : false,
                mousedrag = ($(this).parent().data('mousedrag') === 1) ? true : false,
                touchdrag = ($(this).parent().data('touchdrag') === 1) ? true : false,
                hoverpause = ($(this).parent().data('hoverpause') === 1) ? true : false,
                items = $(this).parent().data('items') || 1,
                margin = $(this).parent().data('margin') || 0,
                stagepadding = $(this).parent().data('stagepadding') || 0;
            if ($(this).find('.slide').length === 1) {
                loop = false;
            }
            $(this).owlCarousel({
                loop: loop,
                margin: 0,
                nav: nav,
                dots: dots,
                navText: [, ],
                autoplay: autoplay,
                autoplayTimeout: interval,
                mouseDrag: mousedrag,
                touchDrag: touchdrag,
                autoplayHoverPause: hoverpause,
                margin: margin,
                stagePadding: stagepadding,
                smartSpeed: 450,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: items
                    },
                    1200: {
                        items: items
                    }
                }
            });
        });
    }


    // Tooltips
    //------------------------------------------------------------------------------
    function hypermarketTooltipInitialization(selector) {
        if (typeof selector === "undefined" || selector === null) { 
            selector = '';
        }
        var $tooltip = $(selector + '[data-toggle="tooltip"]');
        if ($tooltip.length > 0) {
            $tooltip.tooltip();
        }
    }
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
        var loader = allbuttons.next('#hypermarket-sl-loader');
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
    function hypermarketMakeIframeResponsive(selector) {
        if (typeof selector === "undefined" || selector === null) { 
            selector = '';
        }
        if ($(selector + 'iframe').length > 0) {
            $(selector + 'iframe').each(function() {
                if ($(this).hasClass('wp-embedded-content')) {
                    $(this).wrap('<div class="center-block space-bottom"></div>');
                    $(this).attr('width', '100%');
                } else {
                    $(this).wrap('<div class="embed-responsive embed-responsive-16by9 space-bottom"></div>');
                }
            });
        }
    }
    hypermarketMakeIframeResponsive();

    // Single post
    //------------------------------------------------------------------------------
    if ($('.single-post #comments .form-submit').length > 0) {
        $('#comments .form-submit').before($('#comments .col-sm-12').get(0));
        $('#comments .form-submit').addClass('space-bottom-none col-lg-3 col-md-4 col-sm-6 col-lg-offset-9 col-md-offset-8 col-sm-offset-6');
    }

    // Single page
    //------------------------------------------------------------------------------
    if ($('.type-page + #comments .form-submit').length > 0) {
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