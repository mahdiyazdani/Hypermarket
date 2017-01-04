<?php
/**
 * Custom functions that act independently of the theme templates.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0
 */
/**
 * Query WooCommerce activation.
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_is_woocommerce_activated')):
    function hypermarket_is_woocommerce_activated()
    {
        return class_exists('woocommerce') ? true : false;
    }
endif;
/**
 * Check if WooCommerce activated or not?
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_woocommerce_requirement_admin_notice')):
    function hypermarket_woocommerce_requirement_admin_notice()
    {
?>
        <div class="notice notice-warning is-dismissible">
            <p><strong><?php
        _e('Hypermarket is almost ready to help you start selling :)', 'hypermarket'); ?></strong></p>
            <p><?php
        printf(__('Install and activate %s to start your e-commerce website now!', 'hypermarket') , '<a href="' . hypermarket_sanitize_url( get_admin_url() ) . '/plugin-install.php?tab=plugin-information&amp;plugin=woocommerce&amp;TB_iframe=true" class="thickbox" data-title="WooCommerce">WooCommerce</a>'); ?></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php
        _e('Dismiss this notice.', 'hypermarket'); ?></span>
            </button>
        </div>
        <?php
    }
endif;
if (!hypermarket_is_woocommerce_activated()):
    add_action('admin_notices', 'hypermarket_woocommerce_requirement_admin_notice');
endif;
/**
 * Query Homepage template usage.
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_is_homepage_template')):
    function hypermarket_is_homepage_template()
    {
        return is_page_template('page-templates/template-homepage.php') ? true : false;
    }
endif;
/**
 * Call/Run a shortcode function by tag name.
 *
 * @since 1.0
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
 * Sanitize text
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_sanitize_text')):
    function hypermarket_sanitize_text($text)
    {
        return sanitize_text_field($text);
    }
endif;
/**
 * Sanitize textarea
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_sanitize_textarea')):
    function hypermarket_sanitize_textarea($text)
    {
        return esc_textarea($text);
    }
endif;
/**
 * Sanitize URL
 *
 * @since 1.0
 */
if (!function_exists('hypermarket_sanitize_url')):
    function hypermarket_sanitize_url($url)
    {
        return esc_url($url);
    }
endif;
/**
 * Returns true if a blog has more than 1 category.
 *
 * @since 1.0
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
 * @since 1.0
 */
if (!function_exists('hypermarket_comments_list')):
    function hypermarket_comments_list($comment, $args, $depth)
    {
?>
        <li id="comment-<?php
        comment_ID(); ?>" <?php
        comment_class(); ?>>
            <div class="comment-author-ava">
              <?php echo get_avatar($comment, 60); ?>
            </div><!-- .comment-author-ava -->
            <div class="comment-body">
              <div class="comment-meta">
                <div class="column">
                    <p class="meta">
                        <strong itemprop="author"><?php
        echo (!empty(get_comment_author_url($comment))) ? '<a href="' . get_comment_author_url($comment) . '" class="hypermarket-link-style" target="_blank" rel="external nofollow">' . get_comment_author($comment) . '</a>' : get_comment_author($comment); ?></strong> – <?php
        echo '<time datetime="' . get_comment_date('c') . '">' . get_comment_date() . '</time>'; ?>:
                    </p><!-- .meta -->
                </div><!-- .column -->
                <div class="column">
                  <span class="comment-reply">
                    <?php
        comment_reply_link(array_merge($args, array(
            'reply_text' => '<i class="material-icons reply"></i>',
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
            echo '<em class="hypermarket-comment-awaiting-moderation">' . __('Your comment is awaiting moderation.', 'hypermarket') . '</em>' . PHP_EOL;
        endif;
?>
            </div><!-- .comment-body -->
            <?php
    }
endif;