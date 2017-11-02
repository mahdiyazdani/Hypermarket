<?php
/**
 * Custom functions that act independently of the theme templates.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.3.8
 */
/**
 * Query WooCommerce activation.
 *
 * @since 1.0.0
 */
if (!function_exists('hypermarket_is_woocommerce_activated')):
    function hypermarket_is_woocommerce_activated()
    {
        return class_exists('woocommerce') ? true : false;
    }
endif;
/**
 * Query Homepage template usage.
 *
 * @since 1.0.0
 */
if (!function_exists('hypermarket_is_homepage_template')):
    function hypermarket_is_homepage_template()
    {
        return is_page_template('page-templates/template-homepage.php') ? true : false;
    }
endif;
/**
 * Query Fluid template usage.
 *
 * @since 1.0.3
 */
if (!function_exists('hypermarket_is_fluid_template')):
    function hypermarket_is_fluid_template()
    {
        return is_page_template('page-templates/template-fluid.php') ? true : false;
    }
endif;
/**
 * Append "fluid" class to sections with container class.
 *
 * @since 1.0.3
 */
if (!function_exists('hypermarket_fluid_template_class')):
    function hypermarket_fluid_template_class()
    {
        if(hypermarket_is_fluid_template()):
            return true;
        else:
            return false;
        endif;
    }
endif;
add_filter('hypermarket_fluid_template', 'hypermarket_fluid_template_class', 10);
/**
 * Call/Run a shortcode function by tag name.
 *
 * @link https://github.com/woocommerce/storefront/blob/master/inc/storefront-functions.php#L33-L52
 * @since 1.0.0
 */
if (!function_exists('hypermarket_do_shortcode')):
    function hypermarket_do_shortcode($tag, array $atts = array() , $content = null)
    {
        global $shortcode_tags;
        if (!isset($shortcode_tags[$tag])):
            return false;
        endif;
        return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
    }
endif;
/**
 * Sanitize Checkbox
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 * @since 1.0.4.3
 */
if (!function_exists('hypermarket_sanitize_checkbox')):
    function hypermarket_sanitize_checkbox($checked)
    {
        return ((isset($checked) && true == $checked) ? true : false);
    }
endif;
/**
 * Determines whether or not the current post is a paginated post.
 * 
 * @since 1.0.4
 */
if (!function_exists('hypermarket_is_post_paginated')):
    function hypermarket_is_post_paginated()
    {
        global $multipage;
        return 0 !== $multipage;
    }
endif;
/**
 * Returns true if a blog has more than 1 category.
 *
 * @since 1.0.0
 */
if (!function_exists('hypermarket_categorized_blog')):
    function hypermarket_categorized_blog()
    {
        if (false === ($all_the_cool_cats = get_transient('hypermarket_categories'))):
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields' => 'ids',
                'hide_empty' => 1,
                // We only need to know if there is more than one category.
                'number' => 2,
            ));
            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);
            set_transient('hypermarket_categories', $all_the_cool_cats);
        endif;
        if ($all_the_cool_cats > 1):
            // This blog has more than 1 category so hypermarket_categorized_blog should return true.
            return true;
        else:
            // This blog has only 1 category so hypermarket_categorized_blog should return false.
            return false;
        endif;
    }
endif;
/**
 * Comments list template.
 *
 * @since 1.0.5
 */
if (!function_exists('hypermarket_comments_list')):
    function hypermarket_comments_list($comment, $args, $depth)
    {
        ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <div class="comment-author-ava">
                <?php echo get_avatar($comment, 60); ?>
            </div><!-- .comment-author-ava -->
            <div class="comment-body">
              <div class="comment-meta">
                <div class="column">
                    <p class="meta">
                        <strong itemprop="author">
                        <?php 
                        $get_comment_author_url = esc_url(get_comment_author_url($comment));
                        echo (!empty($get_comment_author_url)) ? '<a href="' . $get_comment_author_url . '" class="hypermarket-link-style" target="_blank" rel="external nofollow">' . esc_html(get_comment_author($comment)) . '</a>' : esc_html(get_comment_author($comment)); 
                        ?>
                        </strong> &ndash; 
                        <?php
                        echo '<a href="' . esc_url(get_comment_link($comment)) . '" class="comment-permalink scroll-to" target="_self" data-comment-id="comment-' . esc_attr(get_comment_ID()) . '"><time datetime="' . esc_attr(get_comment_date('c')) . '">' . esc_html(get_comment_date()) . '</time></a>';         
                        ?>:
                    </p><!-- .meta -->
                </div><!-- .column -->
                <div class="column">
                  <span class="comment-reply">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'reply_text' => wp_kses_post('<i class="material-icons reply"></i>'),
                        'depth' => $depth,
                        'max_depth' => $args['max_depth']
                    )));
                    ?>
                  </span><!-- .comment-reply -->
                </div><!-- .column -->
              </div><!-- .comment-meta -->
                <?php
                comment_text($comment);
                if ('0' == $comment->comment_approved):
                    echo '<em class="hypermarket-comment-awaiting-moderation">' . esc_html__('Your comment is awaiting moderation.', 'hypermarket') . '</em>';
                endif;
                ?>
            </div><!-- .comment-body -->
            <?php
    }
endif;
/**
 * Hypermarket Credits.
 * Hypermarket theme comes as standard with a free download link mark. If you wish to remove this and update it with your text, you need to purchase Hypermarket Plus plugin.
 * 
 * @link https://www.mypreview.one
 * @since 1.0.6.1
 */
if (!function_exists('hypermarket_credits')):
    function hypermarket_credits()
    {
        echo '<p class="copyright space-top"><span>' . apply_filters('hypermarket_copyright_text', $content = '&copy; ' . get_bloginfo('name') . ' ' . date_i18n(__('Y','hypermarket'))) . '</span>';
        if( apply_filters( 'hypermarket_credit_link', true ) ):
            // You `HAVE` to keep this credit link. We really do appreciate it ;)
            printf(esc_attr__(' | Get %1$s for free.', 'hypermarket') , '<a href="' . esc_url(HypermarketThemeURI ) . '" rel="author" target="_blank">' . esc_attr(HypermarketThemeName) . '</a>');
        endif;
        echo '</p>';
    }
endif;
/**
 * This "Back to top" link allows users to smoothly scroll back to the top of the pages.
 * 
 * @since 1.0.4
 */
if (!function_exists('hypermarket_scroll_top')):
    function hypermarket_scroll_top()
    {
        ?>
        <!-- Scroll To Top Button -->
        <div class="scroll-to-top-btn"><i class="material-icons trending_flat"></i></div>
        <?php
    }
endif;