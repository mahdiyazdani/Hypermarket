<?php
/**
 * Hypermarket Customizer.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.4.3
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
         * @since 1.0.3
         */
        public function __construct()

        {
            add_action('customize_register', array(
                $this,
                'customize_register'
            ) , 10);
        }
        /**
         * Theme Customizer along with several other settings.
         *
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         * @since 1.0.4.3
         */
        function customize_register($wp_customize)
        {
            $wp_customize->add_setting('hypermarket_mobile_blogname', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control('hypermarket_mobile_blogname', array(
                'label' => __('Site Title', 'hypermarket') ,
                'description' => __('Works on small screen devices only!', 'hypermarket') ,
                'section' => 'title_tagline',
                'type' => 'text',
                'priority' => 10,
                'settings' => 'hypermarket_mobile_blogname'
            ));
            $wp_customize->add_setting('hypermarket_toggle_tagline', array(
                'default' => apply_filters('hypermarket_toggle_tagline_default', false),
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'hypermarket_sanitize_checkbox'
            ));
            $wp_customize->add_control('hypermarket_toggle_tagline', array(
                'label' => __('Display Site Tagline', 'hypermarket') ,
                'section' => 'title_tagline',
                'type' => 'checkbox',
                'priority' => 20,
                'settings' => 'hypermarket_toggle_tagline'
            ));
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
                $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
                $wp_customize->get_control('blogdescription')->priority = 15;
                $wp_customize->selective_refresh->add_partial('blogdescription', array(
                    'selector' => '#site-tagline-visible-desktop',
                    'render_callback' => function ()
                    {
                        return bloginfo('description');
                    }
                ));
                $wp_customize->get_setting('hypermarket_mobile_blogname')->transport = 'postMessage';
                $wp_customize->selective_refresh->add_partial('hypermarket_mobile_blogname', array(
                    'selector' => '#site-logo-visible-mobile',
                    'render_callback' => function ()
                    {
                        return get_theme_mod('hypermarket_mobile_blogname');
                    }
                ));
            endif;
        }
    }
endif;
return new Hypermarket_Customizer();