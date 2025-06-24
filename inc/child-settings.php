<?php

add_action('admin_init', 'csomasterchild_setup_theme_settings' );
function csomasterchild_setup_theme_settings() {
	
	register_setting( 'general', 'csomasterchild_updates_key' );
	add_settings_field('csomasterchild_updates_key', 'School Theme Update Key', 'csomasterchild_updates_key_cb', 'general', 'default' );

	function csomasterchild_updates_key_cb($args)
	{ 
		$name = 'School Theme Update Key';
		$id = 'csomasterchild_updates_key';
		$value = get_option('csomasterchild_updates_key');

		// Could use ob_start.
		$html  = '';
		$html .= '<input id="' . esc_attr( $id ) . '" 
		name="' . esc_attr( 'csomasterchild_updates_key' ) .'" 
		type="password" value="' . $value . '" class="regular-text ltr" />';
		$html .= '<p class="description">' . esc_html( 'Used to get theme updates to this school theme.' ) .'</p>';
		$html .= '<b class="wntip" data-title="'. esc_attr( 'School Theme Update Key' ) .'"></b>';

		echo $html;
	}
}