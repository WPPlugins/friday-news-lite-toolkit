<?php

class Friday_News_Toolkit_Shortcode{
	
	function __construct() {
		add_action('admin_init', array( $this, 'admin_init' ) );
	}

	public function admin_init() {
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_external_plugins', array( $this, 'mce_external_plugins' ) );
			add_filter( 'mce_buttons', array( $this, 'mce_buttons' ) );
		}
	}

	public function mce_external_plugins( $plugin_array ) {
	    $plugin_array['friday_shortcodes'] = FT_DIR . "assets/js/tinymce.js";
	    return $plugin_array;
	}

	public function mce_buttons( $buttons ) {
	    $buttons[] = 'friday_shortcodes';
	    return $buttons;
	}

	public function load_shortcodes() {
		require FT_PATH . 'inc/shortcodes/tabs.php';		
		require FT_PATH . 'inc/shortcodes/accordions.php';
		require FT_PATH . 'inc/shortcodes/toggle.php';
		require FT_PATH . 'inc/shortcodes/dropcaps.php';
		require FT_PATH . 'inc/shortcodes/alert.php';
		require FT_PATH . 'inc/shortcodes/blockquote.php';
		require FT_PATH . 'inc/shortcodes/button.php';
		require FT_PATH . 'inc/shortcodes/grid.php';
		require FT_PATH . 'inc/shortcodes/gallery.php';
	}
}

$Friday_News_Toolkit_Shortcodes = new Friday_News_Toolkit_Shortcode();
$Friday_News_Toolkit_Shortcodes->load_shortcodes();