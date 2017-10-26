<?php
/**
 * Hypermarket Customizer.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.3.8
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
        private $admin_assets_url;
        /**
         * Setup class.
         *
         * @since 1.0.6.1
         */
        public function __construct()

        {
            $this->admin_assets_url = esc_url(get_template_directory_uri() . '/assets/admin/');
            add_action('customize_register', array(
                $this,
                'customize_register'
            ) , 10);
            add_action('customize_controls_enqueue_scripts', array(
                $this,
                'enqueue'
            ) , 0);
        }
        /**
         * Theme Customizer along with several other settings.
         *
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         * @since 1.3.8
         */
        public function customize_register($wp_customize)
        
        {
            $wp_customize->add_setting('hypermarket_mobile_logo', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'hypermarket_mobile_logo', array(
                'label' => __('Logo', 'hypermarket') ,
                'description' => __('Works on small screen devices only!', 'hypermarket') ,
                'section' => 'title_tagline',
                'priority' => 9,
                'settings' => 'hypermarket_mobile_logo',
                'height' => 80,
                'width' => 310,
                'flex_width'  => true,
                'flex-height' => false
            )));
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
            require get_template_directory() . '/includes/classes/class-customizer-go-plus.php';
            $wp_customize->register_section_type('Hypermarket_Customizer_Go_Plus');
            $wp_customize->add_section(
                new Hypermarket_Customizer_Go_Plus(
                    $wp_customize,
                    'hypermarket_go_plus_control',
                    array(
                        'title' =>   __('Hypermarket Plus', 'hypermarket') ,
                        'go_plus_text'  =>   __('Upgrade Now!', 'hypermarket') ,
                        'go_plus_url'   =>  esc_url(HypermarketThemeURI)
                    )
                )
            );
        }
        /**
         * Enqueue scripts and styles.
         *
         * @since 1.3.8
         */
        public function enqueue()
        
        {
            wp_enqueue_style('hypermarket-customizer-styles', $this->admin_assets_url . 'css/hypermarket-customizer.css', array() , HypermarketThemeVersion);
            wp_enqueue_script('hypermarket-customizer-scripts', $this->admin_assets_url . 'js/hypermarket-customizer.js', array(
                'jquery'
            ) , HypermarketThemeVersion, true);
        }
    }
endif;
return new Hypermarket_Customizer();