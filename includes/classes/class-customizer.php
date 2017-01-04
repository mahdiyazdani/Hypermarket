<?php
/**
 * Hypermarket Customizer.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0
 */
if (!defined('ABSPATH')):
    exit;
endif;
if (!class_exists('Hypermarket_Customizer')):
    /**
     * The Hypermarket Customizer class
     */
    class Hypermarket_Customizer

    {
        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct()

        {
            add_action('customize_register', array(
                $this,
                'customize_register'
            ) , 10);
            add_action('customize_controls_print_footer_scripts', array(
                $this,
                'print_footer_scripts'
            ) , 999);
        }
        /**
         * Theme Customizer along with several other settings.
         *
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         * @since 1.0
         */
        function customize_register($wp_customize)
        {
            // Abort if selective refresh is not available.
            if (isset($wp_customize->selective_refresh)):
                $wp_customize->get_setting('blogname')->transport = 'postMessage';
                $wp_customize->selective_refresh->add_partial('custom_logo', array(
                    'selector' => '#site-logo-visible-desktop',
                    'render_callback' => function ()
                    {
                        return hypermarket_site_brand();
                    }
                ));
                $wp_customize->selective_refresh->add_partial('blogname', array(
                    'selector' => '#site-logo-visible-desktop',
                    'render_callback' => function ()
                    {
                        return bloginfo('name');
                    }
                ));
            endif;
            $wp_customize->add_setting('hypermarket_mobile_blogname', array(
                'default' => '[ H / M ]',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'hypermarket_sanitize_text'
            ));
            // Abort if selective refresh is not available.
            if (isset($wp_customize->selective_refresh)):
                $wp_customize->get_setting('hypermarket_mobile_blogname')->transport = 'postMessage';
                $wp_customize->selective_refresh->add_partial('hypermarket_mobile_blogname', array(
                    'selector' => '#site-logo-visible-mobile',
                    'render_callback' => function ()
                    {
                        return get_theme_mod('hypermarket_mobile_blogname');
                    }
                ));
            endif;
            $wp_customize->add_control('hypermarket_mobile_blogname', array(
                'label' => __('Site Title (<768px)', 'hypermarket') ,
                'section' => 'title_tagline',
                'type' => 'text',
                'settings' => 'hypermarket_mobile_blogname'
            ));
        }
        /**
         * Display Hypermarket Plus back-link in the Customizer controls header.
         *
         * @since 1.0
         */
        public function print_footer_scripts()

        {
            if (!class_exists('BS3_Grid_Builder_Activation')):
                $bs3_grid_builder = hypermarket_sanitize_url(get_admin_url()) . 'plugin-install.php?s=bs3+grid+builder&tab=search&type=term';
?>
                <script type="application/javascript">
                    (function($) {
                        $(document).ready(function() {
                            var hypermarket_plus = $('<br/><a class="get-hypermarket-plus"></a>')
                                .attr('href', '<?php echo $bs3_grid_builder; ?>')
                                .attr('target', '_blank')
                                .text('<?php esc_html_e('Get Free Grid Builder!', 'hypermarket'); ?>')
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
                            $('#accordion-section-themes .accordion-section-title .change-theme').before(hypermarket_plus);
                            // Remove accordion click event
                            $('.get-hypermarket-plus').on('click', function(e) {
                                e.stopPropagation();
                            });
                        });
                    })(jQuery);
                </script>
            <?php
            endif;
        }
    }
endif;
return new Hypermarket_Customizer();