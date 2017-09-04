<?php
/**
 * Social font icons Widget.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.2.1
 */
if (!defined('ABSPATH')):
    exit;
endif;
if (!class_exists('Hypermarket_Social_Icons_Widget')):
    /**
     * The social font icons class
     */
    class Hypermarket_Social_Icons_Widget extends WP_Widget

    {
        /**
         * Setup class.
         *
         * @since 1.0.5
         */
        public function __construct()

        {
            parent::__construct('hypermarket-social-icons-widget', __('Social Icons', 'hypermarket') . ' (' . HypermarketThemeName . ')', array(
                'customize_selective_refresh' => true,
                'classname' => 'hypermarket-social-icons-widget',
                'description' => __('A simple widget that displays social network icons.', 'hypermarket')
            ));
        }
        /**
         * Outputs the content of the widget.
         *
         * @since 1.0.5
         */
        public function widget($args, $instance)

        {
            // Extracting the arguments + getting the values
            $cache = wp_cache_get('hypermarket_payment_methods_icons_widget', 'widget');
            if (!is_array($cache)):
                $cache = array();
            endif;
            if (!isset($args['widget_id'])):
                $args['widget_id'] = $this->id;
            endif;
            if (isset($cache[$args['widget_id']])):
                echo $cache[$args['widget_id']];
                return;
            endif;
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('hypermarket_social_icons_widget_title', $instance['title']);
            $icon_1 = empty($instance['icon_1']) ? '' : esc_attr($instance['icon_1']);
            $icon_url_1 = empty($instance['icon_url_1']) ? '' : esc_url($instance['icon_url_1']);
            $icon_2 = empty($instance['icon_2']) ? '' : esc_attr($instance['icon_2']);
            $icon_url_2 = empty($instance['icon_url_2']) ? '' : esc_url($instance['icon_url_2']);
            $icon_3 = empty($instance['icon_3']) ? '' : esc_attr($instance['icon_3']);
            $icon_url_3 = empty($instance['icon_url_3']) ? '' : esc_url($instance['icon_url_3']);
            $icon_4 = empty($instance['icon_4']) ? '' : esc_attr($instance['icon_4']);
            $icon_url_4 = empty($instance['icon_url_4']) ? '' : esc_url($instance['icon_url_4']);
            $icon_5 = empty($instance['icon_5']) ? '' : esc_attr($instance['icon_5']);
            $icon_url_5 = empty($instance['icon_url_5']) ? '' : esc_url($instance['icon_url_5']);
            $icon_6 = empty($instance['icon_6']) ? '' : esc_attr($instance['icon_6']);
            $icon_url_6 = empty($instance['icon_url_6']) ? '' : esc_url($instance['icon_url_6']);
            $icon_7 = empty($instance['icon_7']) ? '' : esc_attr($instance['icon_7']);
            $icon_url_7 = empty($instance['icon_url_7']) ? '' : esc_url($instance['icon_url_7']);
            $icon_8 = empty($instance['icon_8']) ? '' : esc_attr($instance['icon_8']);
            $icon_url_8 = empty($instance['icon_url_8']) ? '' : esc_url($instance['icon_url_8']);
            $icon_9 = empty($instance['icon_9']) ? '' : esc_attr($instance['icon_9']);
            $icon_url_9 = empty($instance['icon_url_9']) ? '' : esc_url($instance['icon_url_9']);
            // Before widget code, if any
            $output = $args['before_widget'];
            // The title and the text output
            if ($title):
                $output.= $args['before_title'] . $title . $args['after_title'];
            endif;
            $output.= '<ul>';
            for ($counter = 1; $counter <= 9; $counter++):
                if (!empty(${'icon_' . $counter}) && !empty(${'icon_url_' . $counter})):
                    $output.= '<li><a href="' . esc_url(${'icon_url_' . $counter}) . '" target="_blank"><i class="hypermarket-icon hypermarket-' . esc_attr(${'icon_' . $counter}) . '"></i></a></li>';
                endif;
            endfor;
            $output.= '</ul>';
            // After widget code, if any
            $output.= $args['after_widget'];
            echo $output;
            $cache[$args['widget_id']] = $output;
            wp_cache_set('hypermarket_payment_methods_icons_widget', $cache, 'widget');
        }
        /**
         * Generates the administration form for the widget.
         * 
         * @since 1.2.1
         */
        public function form($instance)

        {
            $defaults = array(
                'title' => __('Follow Us', 'hypermarket') ,
                'icon_1' => 'facebook',
                'icon_url_1' => '',
                'icon_2' => 'google-plus',
                'icon_url_2' => '',
                'icon_3' => 'instagram',
                'icon_url_3' => '',
                'icon_4' => 'linkedin',
                'icon_url_4' => '',
                'icon_5' => 'pinterest',
                'icon_url_5' => '',
                'icon_6' => 'twitter',
                'icon_url_6' => '',
                'icon_7' => 'vimeo',
                'icon_url_7' => '',
                'icon_8' => 'wordpress',
                'icon_url_8' => '',
                'icon_9' => 'youtube',
                'icon_url_9' => ''
            );
            // Extract the data from the instance variable
            $args = wp_parse_args($instance, $defaults);
            $title = empty($args['title']) ? '' : esc_attr($args['title']);
            $icon_1 = empty($args['icon_1']) ? '' : esc_attr($args['icon_1']);
            $icon_url_1 = empty($args['icon_url_1']) ? '' : esc_url($args['icon_url_1']);
            $icon_2 = empty($args['icon_2']) ? '' : esc_attr($args['icon_2']);
            $icon_url_2 = empty($args['icon_url_2']) ? '' : esc_url($args['icon_url_2']);
            $icon_3 = empty($args['icon_3']) ? '' : esc_attr($args['icon_3']);
            $icon_url_3 = empty($args['icon_url_3']) ? '' : esc_url($args['icon_url_3']);
            $icon_4 = empty($args['icon_4']) ? '' : esc_attr($args['icon_4']);
            $icon_url_4 = empty($args['icon_url_4']) ? '' : esc_url($args['icon_url_4']);
            $icon_5 = empty($args['icon_5']) ? '' : esc_attr($args['icon_5']);
            $icon_url_5 = empty($args['icon_url_5']) ? '' : esc_url($args['icon_url_5']);
            $icon_6 = empty($args['icon_6']) ? '' : esc_attr($args['icon_6']);
            $icon_url_6 = empty($args['icon_url_6']) ? '' : esc_url($args['icon_url_6']);
            $icon_7 = empty($args['icon_7']) ? '' : esc_attr($args['icon_7']);
            $icon_url_7 = empty($args['icon_url_7']) ? '' : esc_url($args['icon_url_7']);
            $icon_8 = empty($args['icon_8']) ? '' : esc_attr($args['icon_8']);
            $icon_url_8 = empty($args['icon_url_8']) ? '' : esc_url($args['icon_url_8']);
            $icon_9 = empty($args['icon_9']) ? '' : esc_attr($args['icon_9']);
            $icon_url_9 = empty($args['icon_url_9']) ? '' : esc_url($args['icon_url_9']);
            // Display the fields
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'hypermarket'); ?>:</label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo $title; ?>" class="widefat" />
            </p>
            <?php for ($counter = 1; $counter <= 9; $counter++): ?>
            <p>
                <label for="icon_<?php echo $counter; ?>">
                    <?php printf(esc_attr__('Icon %1$s:', 'hypermarket') , $counter); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('icon_' . $counter)); ?>" name="<?php echo esc_attr($this->get_field_name('icon_' . $counter)); ?>">
                    <option value="">.:: <?php esc_html_e('Select', 'hypermarket'); ?> ::.</option>
                    <option value="facebook" <?php echo esc_attr(selected(${'icon_' . $counter}, 'facebook')); ?>><?php esc_html_e('Facebook', 'hypermarket'); ?></option>
                    <option value="google-plus" <?php echo esc_attr(selected(${'icon_' . $counter}, 'google-plus')); ?>><?php esc_html_e('Google Plus', 'hypermarket'); ?></option>
                    <option value="instagram" <?php echo esc_attr(selected(${'icon_' . $counter}, 'instagram')); ?>><?php esc_html_e('Instagram', 'hypermarket'); ?></option>
                    <option value="linkedin" <?php echo esc_attr(selected(${'icon_' . $counter}, 'linkedin')); ?>><?php esc_html_e('Linkedin', 'hypermarket'); ?></option>
                    <option value="pinterest" <?php echo esc_attr(selected(${'icon_' . $counter}, 'pinterest')); ?>><?php esc_html_e('Pinterest', 'hypermarket'); ?></option>
                    <option value="twitter" <?php echo esc_attr(selected(${'icon_' . $counter}, 'twitter')); ?>><?php esc_html_e('Twitter', 'hypermarket'); ?></option>
                    <option value="vimeo" <?php echo esc_attr(selected(${'icon_' . $counter}, 'vimeo')); ?>><?php esc_html_e('Vimeo', 'hypermarket'); ?></option>
                    <option value="wordpress" <?php echo esc_attr(selected(${'icon_' . $counter}, 'wordpress')); ?>><?php esc_html_e('WordPress', 'hypermarket'); ?></option>
                    <option value="youtube" <?php echo esc_attr(selected(${'icon_' . $counter}, 'youtube')); ?>><?php esc_html_e('Youtube', 'hypermarket'); ?></option>
                </select>
            </p>
            <p>
                <label for="icon_url_<?php echo $counter; ?>">
                    <?php printf(esc_attr__('Icon URL %1$s:', 'hypermarket') , $counter); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('icon_url_' . $counter)); ?>" name="<?php echo esc_attr($this->get_field_name('icon_url_' . $counter)); ?>" type="text" value="<?php echo esc_url($args['icon_url_' . $counter]); ?>" />
            </p>
            <?php
            endfor;
        }
        /**
         * Processes the widget's options to be saved.
         *
         * @since 1.0.5.1
         */
        public function update($new_instance, $old_instance)
        
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['icon_1'] = sanitize_text_field($new_instance['icon_1']);
            $instance['icon_url_1'] = esc_url_raw($new_instance['icon_url_1']);
            $instance['icon_2'] = sanitize_text_field($new_instance['icon_2']);
            $instance['icon_url_2'] = esc_url_raw($new_instance['icon_url_2']);
            $instance['icon_3'] = sanitize_text_field($new_instance['icon_3']);
            $instance['icon_url_3'] = esc_url_raw($new_instance['icon_url_3']);
            $instance['icon_4'] = sanitize_text_field($new_instance['icon_4']);
            $instance['icon_url_4'] = esc_url_raw($new_instance['icon_url_4']);
            $instance['icon_5'] = sanitize_text_field($new_instance['icon_5']);
            $instance['icon_url_5'] = esc_url_raw($new_instance['icon_url_5']);
            $instance['icon_6'] = sanitize_text_field($new_instance['icon_6']);
            $instance['icon_url_6'] = esc_url_raw($new_instance['icon_url_6']);
            $instance['icon_7'] = sanitize_text_field($new_instance['icon_7']);
            $instance['icon_url_7'] = esc_url_raw($new_instance['icon_url_7']);
            $instance['icon_8'] = sanitize_text_field($new_instance['icon_8']);
            $instance['icon_url_8'] = esc_url_raw($new_instance['icon_url_8']);
            $instance['icon_9'] = sanitize_text_field($new_instance['icon_9']);
            $instance['icon_url_9'] = esc_url_raw($new_instance['icon_url_9']);
            wp_cache_delete('hypermarket_payment_methods_icons_widget', 'widget');
            return $instance;
        }
    }
endif;
/**
 * Register the Widget.
 *
 * @package Hooked into "widgets_init"
 * @since 1.0.5.1
 */
if (!function_exists('hypermarket_register_social_icons_widget')):
    function hypermarket_register_social_icons_widget()
    {
        register_widget('Hypermarket_Social_Icons_Widget');
    }
endif;
add_action('widgets_init', 'hypermarket_register_social_icons_widget', 10);