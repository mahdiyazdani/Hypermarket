<?php
/**
 * Hypermarket Customizer Go Plus.
 *
 * @author      Mahdi Yazdani
 * @package     Hypermarket
 * @since       1.1.1
 */
if (!defined('ABSPATH')):
    exit;
endif;
if (!class_exists('Hypermarket_Customizer_Go_Plus')):
    /**
     * The Hypermarket Customizer Go Plus Section class
     */
    class Hypermarket_Customizer_Go_Plus extends WP_Customize_Section

    {
    	public $type = 'hypermarket-plus';
    	public $go_plus_text = '';
    	public $go_plus_url = '';
        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since 1.0.6.1
         */
        public function json()

        {
            $json = parent::json();
            $json['go_plus_text'] = $this->go_plus_text;
            $json['go_plus_url']  = esc_url( $this->go_plus_url );
            return $json;
        }
        /**
         * Outputs the Underscore.js template.
         *
         * @since 1.1.1
         */
        protected function render_template()
        
        {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}
					<# if ( data.go_plus_text && data.go_plus_url ) { #>
						<a href="{{ data.go_plus_url }}" class="button button-primary alignright" target="_blank">{{ data.go_plus_text }}</a>
					<# } #>
				</h3>
			</li>
            <?php
        }
    }
endif;