<?php
/**
 * Social font icons Widget.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.0.4.1
 */
if (!defined('ABSPATH')):
    exit;
endif;
class Hypermarket_Social_Icons_Widget extends WP_Widget

{
    public function __construct()

    {
        parent::__construct('hypermarket-social-icons-widget', __('Social Icons', 'hypermarket') . ' (' . HypermarketThemeName . ')', array(
            'customize_selective_refresh' => true,
            'classname' => 'hypermarket-social-icons-widget',
            'description' => __('A simple widget that displays social network icons.', 'hypermarket')
        ));
    }
    // Outputs the content of the widget.
    function widget($args, $instance)
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
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $icon_1 = empty($instance['icon_1']) ? '' : esc_attr($instance['icon_1']);
        $icon_url_1 = empty($instance['icon_url_1']) ? '' : esc_attr($instance['icon_url_1']);
        $icon_2 = empty($instance['icon_2']) ? '' : esc_attr($instance['icon_2']);
        $icon_url_2 = empty($instance['icon_url_2']) ? '' : esc_attr($instance['icon_url_2']);
        $icon_3 = empty($instance['icon_3']) ? '' : esc_attr($instance['icon_3']);
        $icon_url_3 = empty($instance['icon_url_3']) ? '' : esc_attr($instance['icon_url_3']);
        $icon_4 = empty($instance['icon_4']) ? '' : esc_attr($instance['icon_4']);
        $icon_url_4 = empty($instance['icon_url_4']) ? '' : esc_attr($instance['icon_url_4']);
        $icon_5 = empty($instance['icon_5']) ? '' : esc_attr($instance['icon_5']);
        $icon_url_5 = empty($instance['icon_url_5']) ? '' : esc_attr($instance['icon_url_5']);
        $icon_6 = empty($instance['icon_6']) ? '' : esc_attr($instance['icon_6']);
        $icon_url_6 = empty($instance['icon_url_6']) ? '' : esc_attr($instance['icon_url_6']);
        $icon_7 = empty($instance['icon_7']) ? '' : esc_attr($instance['icon_7']);
        $icon_url_7 = empty($instance['icon_url_7']) ? '' : esc_attr($instance['icon_url_7']);
        $icon_8 = empty($instance['icon_8']) ? '' : esc_attr($instance['icon_8']);
        $icon_url_8 = empty($instance['icon_url_8']) ? '' : esc_attr($instance['icon_url_8']);
        $icon_9 = empty($instance['icon_9']) ? '' : esc_attr($instance['icon_9']);
        $icon_url_9 = empty($instance['icon_url_9']) ? '' : esc_attr($instance['icon_url_9']);
        // Before widget code, if any
        $output = $args['before_widget'];
        // The title and the text output
        if ($title):
            $output.= $args['before_title'] . $title . $args['after_title'];
        endif;
        $output.= '<ul>' . PHP_EOL;
        for ($counter = 1; $counter <= 9; $counter++):
            if (!empty(esc_attr($instance['icon_' . $counter . '']))):
                $output.= '<li><a href="' . esc_attr($instance['icon_url_' . $counter . '']) . '" target="_blank"><i class="hypermarket-icon hypermarket-' . esc_attr($instance['icon_' . $counter . '']) . '"></i></a></li>' . PHP_EOL;
            endif;
        endfor;
        $output.= '</ul>' . PHP_EOL;
        // After widget code, if any
        $output.= $args['after_widget'];
        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('hypermarket_payment_methods_icons_widget', $cache, 'widget');
    }
    // Generates the administration form for the widget.
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
        $title = esc_attr($args['title']);
        $icon_1 = empty($args['icon_1']) ? '' : esc_attr($args['icon_1']);
        $icon_url_1 = empty($args['icon_url_1']) ? '' : esc_attr($args['icon_url_1']);
        $icon_2 = empty($args['icon_2']) ? '' : esc_attr($args['icon_2']);
        $icon_url_2 = empty($args['icon_url_2']) ? '' : esc_attr($args['icon_url_2']);
        $icon_3 = empty($args['icon_3']) ? '' : esc_attr($args['icon_3']);
        $icon_url_3 = empty($args['icon_url_3']) ? '' : esc_attr($args['icon_url_3']);
        $icon_4 = empty($args['icon_4']) ? '' : esc_attr($args['icon_4']);
        $icon_url_4 = empty($args['icon_url_4']) ? '' : esc_attr($args['icon_url_4']);
        $icon_5 = empty($args['icon_5']) ? '' : esc_attr($args['icon_5']);
        $icon_url_5 = empty($args['icon_url_5']) ? '' : esc_attr($args['icon_url_5']);
        $icon_6 = empty($args['icon_6']) ? '' : esc_attr($args['icon_6']);
        $icon_url_6 = empty($args['icon_url_6']) ? '' : esc_attr($args['icon_url_6']);
        $icon_7 = empty($args['icon_7']) ? '' : esc_attr($args['icon_7']);
        $icon_url_7 = empty($args['icon_url_7']) ? '' : esc_attr($args['icon_url_7']);
        $icon_8 = empty($args['icon_8']) ? '' : esc_attr($args['icon_8']);
        $icon_url_8 = empty($args['icon_url_8']) ? '' : esc_attr($args['icon_url_8']);
        $icon_9 = empty($args['icon_9']) ? '' : esc_attr($args['icon_9']);
        $icon_url_9 = empty($args['icon_url_9']) ? '' : esc_attr($args['icon_url_9']);
        // Display the fields
        echo '<p>' . PHP_EOL;
        echo '<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'hypermarket') . '</label>' . PHP_EOL;
        echo '<input class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" type="text"
       value="' . esc_attr($title) . '" />' . PHP_EOL;
        echo '</p>' . PHP_EOL;
        for ($counter = 1; $counter <= 9; $counter++):
            echo '<p>' . PHP_EOL;
            echo '<label for="icon_' . $counter . '">' . PHP_EOL;
            printf(esc_attr__('Icon %1$s:', 'hypermarket') , $counter);
            echo '</label>' . PHP_EOL;
            $facebook_selected = '';
            $google_plus_selected = '';
            $instagram_selected = '';
            $linkedin_selected = '';
            $pinterest_selected = '';
            $twitter_selected = '';
            $vimeo_selected = '';
            $wordpress_selected = '';
            $youtube_selected = '';
            switch (esc_attr($args['icon_' . $counter])):
            case 'facebook':
                $facebook_selected = 'selected="selected"';
                break;

            case 'google-plus':
                $google_plus_selected = 'selected="selected"';
                break;

            case 'instagram':
                $instagram_selected = 'selected="selected"';
                break;

            case 'linkedin':
                $linkedin_selected = 'selected="selected"';
                break;

            case 'pinterest':
                $pinterest_selected = 'selected="selected"';
                break;

            case 'twitter':
                $twitter_selected = 'selected="selected"';
                break;

            case 'vimeo':
                $vimeo_selected = 'selected="selected"';
                break;

            case 'wordpress':
                $wordpress_selected = 'selected="selected"';
                break;

            case 'youtube':
                $youtube_selected = 'selected="selected"';
                break;

            default:
                break;
            endswitch;
            echo '<select class="widefat" id="' . esc_attr($this->get_field_id('icon_' . $counter)) . '" name="' . esc_attr($this->get_field_name('icon_' . $counter)) . '" type="text">' . PHP_EOL;
            echo '<option value="">.:: ' . esc_html__('Select', 'hypermarket') . ' ::.</option>' . PHP_EOL;
            echo '<option value="facebook" ' . $facebook_selected . '>' . esc_html__('Facebook', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="google-plus" ' . $google_plus_selected . '>' . esc_html__('Google Plus', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="instagram" ' . $instagram_selected . '>' . esc_html__('Instagram', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="linkedin" ' . $linkedin_selected . '>' . esc_html__('Linkedin', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="pinterest" ' . $pinterest_selected . '>' . esc_html__('Pinterest', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="twitter" ' . $twitter_selected . '>' . esc_html__('Twitter', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="vimeo" ' . $vimeo_selected . '>' . esc_html__('Vimeo', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="wordpress" ' . $wordpress_selected . '>' . esc_html__('WordPress', 'hypermarket') . '</option>' . PHP_EOL;
            echo '<option value="youtube" ' . $youtube_selected . '>' . esc_html__('Youtube', 'hypermarket') . '</option>' . PHP_EOL;
            echo '</select>' . PHP_EOL;
            echo '</p>' . PHP_EOL;
            echo '<p>' . PHP_EOL;
            echo '<label for="icon_url_' . $counter . '">' . PHP_EOL;
            printf(esc_attr__('Icon URL %1$s:', 'hypermarket') , $counter);
            echo '</label>' . PHP_EOL;
            echo '<input class="widefat" id="' . esc_attr($this->get_field_id('icon_url_' . $counter)) . '" name="' . esc_attr($this->get_field_name('icon_url_' . $counter)) . '" type="text" value="' . esc_attr($args['icon_url_' . $counter]) . '" />' . PHP_EOL;
            echo '</p>' . PHP_EOL;
        endfor;
    }
    // Processes the widget's options to be saved.
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = hypermarket_sanitize_text($new_instance['title']);
        $instance['icon_1'] = hypermarket_sanitize_text($new_instance['icon_1']);
        $instance['icon_url_1'] = esc_url($new_instance['icon_url_1']);
        $instance['icon_2'] = hypermarket_sanitize_text($new_instance['icon_2']);
        $instance['icon_url_2'] = esc_url($new_instance['icon_url_2']);
        $instance['icon_3'] = hypermarket_sanitize_text($new_instance['icon_3']);
        $instance['icon_url_3'] = esc_url($new_instance['icon_url_3']);
        $instance['icon_4'] = hypermarket_sanitize_text($new_instance['icon_4']);
        $instance['icon_url_4'] = esc_url($new_instance['icon_url_4']);
        $instance['icon_5'] = hypermarket_sanitize_text($new_instance['icon_5']);
        $instance['icon_url_5'] = esc_url($new_instance['icon_url_5']);
        $instance['icon_6'] = hypermarket_sanitize_text($new_instance['icon_6']);
        $instance['icon_url_6'] = esc_url($new_instance['icon_url_6']);
        $instance['icon_7'] = hypermarket_sanitize_text($new_instance['icon_7']);
        $instance['icon_url_7'] = esc_url($new_instance['icon_url_7']);
        $instance['icon_8'] = hypermarket_sanitize_text($new_instance['icon_8']);
        $instance['icon_url_8'] = esc_url($new_instance['icon_url_8']);
        $instance['icon_9'] = hypermarket_sanitize_text($new_instance['icon_9']);
        $instance['icon_url_9'] = esc_url($new_instance['icon_url_9']);
        wp_cache_delete('hypermarket_payment_methods_icons_widget', 'widget');
        return $instance;
    }
}
add_action('widgets_init', create_function('', 'return register_widget("Hypermarket_Social_Icons_Widget");'));