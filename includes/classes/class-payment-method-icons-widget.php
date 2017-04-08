<?php
/**
 * Payment method font icons Widget.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.5.1
 */
if (!defined('ABSPATH')):
    exit;
endif;
if (!class_exists('Hypermarket_Payment_Method_Icons_Widget')):
    /**
     * The payment method font icons class
     */
    class Hypermarket_Payment_Method_Icons_Widget extends WP_Widget

    {
        /**
         * Setup class.
         *
         * @since 1.0.5
         */
        public function __construct()

        {
            parent::__construct('hypermarket-payment-methods-icons-widget', __('Payment Method Icons', 'hypermarket') . ' (' . HypermarketThemeName . ')', array(
                'customize_selective_refresh' => true,
                'classname' => 'hypermarket-payment-methods-icons-widget',
                'description' => __('A simple widget that displays payment method icons.', 'hypermarket')
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
            $title = empty($instance['title']) ? '' : apply_filters('hypermarket_payment_methods_icons_widget_title', $instance['title']);
            $icon_1 = empty($instance['icon_1']) ? '' : esc_attr($instance['icon_1']);
            $icon_2 = empty($instance['icon_2']) ? '' : esc_attr($instance['icon_2']);
            $icon_3 = empty($instance['icon_3']) ? '' : esc_attr($instance['icon_3']);
            $icon_4 = empty($instance['icon_4']) ? '' : esc_attr($instance['icon_4']);
            $icon_5 = empty($instance['icon_5']) ? '' : esc_attr($instance['icon_5']);
            $icon_6 = empty($instance['icon_6']) ? '' : esc_attr($instance['icon_6']);
            // Before widget code, if any
            $output = $args['before_widget'];
            // The title and the text output
            if ($title):
                $output.= $args['before_title'] . $title . $args['after_title'];
            endif;
            $output.= '<ul>';
            for ($counter = 1; $counter <= 6; $counter++):
                if (!empty(${'icon_' . $counter})):
                    $output.= '<li><i class="hypermarket-icon hypermarket-' . esc_attr(${'icon_' . $counter}) . '"></i></li>';
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
         * @since 1.0.5
         */
        public function form($instance)

        {
            $defaults = array(
                'title' => __('Pay Secure', 'hypermarket') ,
                'icon_1' => 'visa',
                'icon_2' => 'skrill',
                'icon_3' => 'master-card',
                'icon_4' => 'paypal',
                'icon_5' => 'amx',
                'icon_6' => 'ssl'
            );
            // Extract the data from the instance variable
            $args = wp_parse_args($instance, $defaults);
            $title = empty($args['title']) ? '' : esc_attr($args['title']);
            $icon_1 = empty($args['icon_1']) ? '' : esc_attr($args['icon_1']);
            $icon_2 = empty($args['icon_2']) ? '' : esc_attr($args['icon_2']);
            $icon_3 = empty($args['icon_3']) ? '' : esc_attr($args['icon_3']);
            $icon_4 = empty($args['icon_4']) ? '' : esc_attr($args['icon_4']);
            $icon_5 = empty($args['icon_5']) ? '' : esc_attr($args['icon_5']);
            $icon_6 = empty($args['icon_6']) ? '' : esc_attr($args['icon_6']);
            // Display the fields
            echo '<p>';
            echo '<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'hypermarket') . '</label>';
            echo '<input class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" type="text"
           value="' . esc_attr($title) . '" />';
            echo '</p>';
            for ($counter = 1; $counter <= 6; $counter++):
                echo '<p>';
                echo '<label for="icon_' . $counter . '">';
                printf(esc_attr__('Icon %1$s:', 'hypermarket') , $counter);
                echo '</label>';
                echo '<select class="widefat" id="' . esc_attr($this->get_field_id('icon_' . $counter)) . '" name="' . esc_attr($this->get_field_name('icon_' . $counter)) . '" type="text">';
                echo '<option value="">.:: ' . esc_html__('Select', 'hypermarket') . ' ::.</option>';
                echo '<option value="visa" ' . esc_attr(selected(${'icon_' . $counter}, 'visa')) . '>' . esc_html__('Visa', 'hypermarket') . '</option>';
                echo '<option value="skrill" ' . esc_attr(selected(${'icon_' . $counter}, 'skrill')) . '>' . esc_html__('Skrill', 'hypermarket') . '</option>';
                echo '<option value="master-card" ' . esc_attr(selected(${'icon_' . $counter}, 'master-card')) . '>' . esc_html__('MasterCard', 'hypermarket') . '</option>';
                echo '<option value="paypal" ' . esc_attr(selected(${'icon_' . $counter}, 'paypal')) . '>' . esc_html__('PayPal', 'hypermarket') . '</option>';
                echo '<option value="amx" ' . esc_attr(selected(${'icon_' . $counter}, 'amx')) . '>' . esc_html__('American Express', 'hypermarket') . '</option>';
                echo '<option value="ssl" ' . esc_attr(selected(${'icon_' . $counter}, 'ssl')) . '>' . esc_html__('SSL Certificate', 'hypermarket') . '</option>';
                echo '</select>';
                echo '</p>';
            endfor;
        }
        /**
         * Processes the widget's options to be saved.
         *
         * @since 1.0.5
         */
        public function update($new_instance, $old_instance)

        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['icon_1'] = sanitize_text_field($new_instance['icon_1']);
            $instance['icon_2'] = sanitize_text_field($new_instance['icon_2']);
            $instance['icon_3'] = sanitize_text_field($new_instance['icon_3']);
            $instance['icon_4'] = sanitize_text_field($new_instance['icon_4']);
            $instance['icon_5'] = sanitize_text_field($new_instance['icon_5']);
            $instance['icon_6'] = sanitize_text_field($new_instance['icon_6']);
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
if (!function_exists('hypermarket_register_payment_methods_icons_widget')):
    function hypermarket_register_payment_methods_icons_widget()
    {
        register_widget( 'Hypermarket_Payment_Method_Icons_Widget' );
    }
endif;
add_action('widgets_init', 'hypermarket_register_payment_methods_icons_widget', 10);