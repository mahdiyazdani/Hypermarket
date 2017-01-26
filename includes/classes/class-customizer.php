<?php
/**
 * Hypermarket Customizer.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.1
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
         * @since 1.0.1
         */
        public function __construct()

        {
            add_action('customize_register', array(
                $this,
                'customize_register'
            ) , 10);
            add_action('customize_controls_enqueue_scripts', array(
                $this,
                'enqueue'
            ) , 10);
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
         * Enqueue scripts and styles.
         *
         * @since 1.0.1
         */
        public function enqueue()

        {
            wp_register_script('hypermarket-customizer', get_template_directory_uri() . '/assets/admin/js/hypermarket-customizer.js', array(
                'jquery'
            ) , HypermarketThemeVersion, true);
            wp_localize_script('hypermarket-customizer', 'hypermarket_upsell', array(
                'upsellURL' => hypermarket_sanitize_url(HypermarketThemeAuthorURI) ,
                'upsellLabel' => __('Looking for more options?', 'hypermarket')
            ));
            if (!class_exists('BS3_Grid_Builder_Activation')):
                wp_localize_script('hypermarket-customizer', 'hypermarket_bs3_grid_builder', array(
                    'bs3GridBuilderURL' => hypermarket_sanitize_url(get_admin_url()) . 'plugin-install.php?s=bs3+grid+builder&tab=search&type=term',
                    'bs3GridBuilderLabel' => __('Get Free Grid Builder!', 'hypermarket')
                ));
            endif;
            wp_enqueue_script('hypermarket-customizer');
        }
    }
endif;
return new Hypermarket_Customizer();