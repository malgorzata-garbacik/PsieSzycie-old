<?php
add_action('customize_register', 'neira_lite_customize_register');
function neira_lite_customize_register($wp_customize)
{
	class Customize_Number_Control extends WP_Customize_Control
    {
		public $type = 'number';
	 
		public function render_content()
        {
			?>
			<label>
			    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			    <input type="number" name="quantity" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width: 70px;"/>
			</label>
			<?php
		}
	}

}

if (class_exists('WP_Customize_Control')) {
    class WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => esc_html__( '&mdash; Select &mdash;', 'neira-lite' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                esc_html($this->label),
				esc_html($dropdown)
            );
        }
    }
}