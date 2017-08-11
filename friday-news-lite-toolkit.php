<?php
/*
Plugin Name: Friday News Lite Toolkit
Description: A specific plugin use in Friday News Lite Theme, included some custom widgets, shortcodes.
Version: 1.0.0
Author: Kopa Theme
Author URI: http://kopatheme.com
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Friday News Lite Toolkit plugin, Copyright 2015 Kopatheme.com
Friday News Lite Toolkit is distributed under the terms of the GNU GPL

Requires at least: 3.8
Tested up to: 4.4.2
Text Domain: friday-news-toolkit
Domain Path: /languages/
*/

define( 'FT_DIR', plugin_dir_url(__FILE__) );
define( 'FT_PATH', plugin_dir_path(__FILE__) );

add_action( 'plugins_loaded', array( 'Friday_News_Toolkit', 'plugins_loaded' ) );	
add_action( 'after_setup_theme', array( 'Friday_News_Toolkit', 'after_setup_theme' ), 20 );	

class Friday_News_Toolkit {

	function __construct() {

		require FT_PATH . 'inc/hook.php';
		require FT_PATH . 'inc/util.php';
		require FT_PATH . 'inc/field.php';
		require FT_PATH . 'inc/widget.php';
		require FT_PATH . 'inc/shortcode.php';

		if(is_admin()){
			#make video shortcode responsive
			add_filter( 'wp_video_shortcode', 'friday_news_toolkit_make_video_shortcode_responsive' );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 20 );
			add_action( 'admin_init', 'friday_news_toolkit_register_metabox_post_featured' );

			#metabox-custom-field
			add_filter( 'kopa_admin_meta_box_field_quote', 'friday_news_toolkit_metabox_field_quote', 10, 5 );
			add_filter( 'kopa_admin_meta_box_field_gallery', 'friday_news_toolkit_metabox_field_gallery', 10, 5 );

			#metabox-custom-wrap
			add_filter( 'kopa_admin_meta_box_wrap_start', 'friday_news_toolkit_meta_box_wrap_start', 10, 3 );
			add_filter( 'kopa_admin_meta_box_wrap_end', 'friday_news_toolkit_meta_box_wrap_end', 10, 3 );			
		} else {
			add_filter( 'embed_handler_html', 'friday_news_toolkit_youtube_settings' );
			add_filter( 'embed_oembed_html', 'friday_news_toolkit_youtube_settings' );
			add_filter( 'excerpt_more', 'friday_news_toolkit_excerpt_more' );
		}
		add_action( 'friday_news_lite_socials_share', array( $this, 'social_sharing_links_single' ) );
		add_action( 'friday_news_lite_socials_share_cat', array( $this, 'socials_share_cat' ) );
		
		add_filter( 'user_contactmethods', 'friday_news_toolkit_add_social_field' );
	}

	public static function plugins_loaded() {
		load_plugin_textdomain( 'friday-news-toolkit', false, FT_PATH . '/languages/' );
	}

	public static function after_setup_theme() {
		if ( ! class_exists( 'Kopa_Framework' ) )
			return; 		
		else	
			new Friday_News_Toolkit();							
	}

	public function admin_enqueue_scripts( $hook ) {
		if( in_array( $hook, array( 'widgets.php', 'post.php', 'post-new.php' ) ) ) {	        
	        wp_enqueue_style( 'friday-toolkit-metabox', FT_DIR . "assets/css/metabox.css", array(), NULL );
	        wp_enqueue_style( 'friday-toolkit-tinymce', FT_DIR . "assets/css/tinymce.css", array(), NULL );
       
	        wp_enqueue_script( 'friday-toolkit-gallery', FT_DIR . "assets/js/gallery.js", array('jquery'), NULL, TRUE );        
	        wp_localize_script( 'jquery', 'friday_toolkit', array(
	            'i18n' => array(
	            	'grid'      	  => esc_html__( 'Grid', 'friday-news-toolkit' ),
					'shortcodes'      => esc_html__( 'Shortcodes', 'friday-news-toolkit' ),
					'container'       => esc_html__( 'Container', 'friday-news-toolkit' ),
					'tabs'            => esc_html__( 'Tabs', 'friday-news-toolkit' ),
					'tabs_background' => esc_html__( 'Tabs (Background)', 'friday-news-toolkit' ),
					'accordion'       => esc_html__( 'Accordion', 'friday-news-toolkit' ),
					'toggle'          => esc_html__( 'Toggle', 'friday-news-toolkit' ),
					'dropcap'         => esc_html__( 'Dropcap', 'friday-news-toolkit' ),
					'transparent'     => esc_html__( 'Transparent', 'friday-news-toolkit' ),
					'border'          => esc_html__( 'Border', 'friday-news-toolkit' ),
					'border_left_top' => esc_html__( 'Border Left Top', 'friday-news-toolkit' ),
					'background'      => esc_html__( 'Background', 'friday-news-toolkit' ),
					'alert'           => esc_html__( 'Alert box', 'friday-news-toolkit' ),
					'info'            => esc_html__( 'Info', 'friday-news-toolkit' ),
					'success'         => esc_html__( 'Success', 'friday-news-toolkit' ),
					'warning'         => esc_html__( 'Warning', 'friday-news-toolkit' ),
					'danger'          => esc_html__( 'Danger', 'friday-news-toolkit' ),
					'button'          => esc_html__( 'Button', 'friday-news-toolkit' ),
					'large'           => esc_html__( 'Large', 'friday-news-toolkit' ),
					'medium'          => esc_html__( 'Medium', 'friday-news-toolkit' ),
					'small'           => esc_html__( 'Small', 'friday-news-toolkit' ),
					'large_yellow'    => esc_html__( 'Yellow', 'friday-news-toolkit' ),
					'large_black'     => esc_html__( 'Black', 'friday-news-toolkit' ),
					'large_gray'      => esc_html__( 'Gray', 'friday-news-toolkit' ),
					'large_pink'      => esc_html__( 'Pink', 'friday-news-toolkit' ),
					'medium_yellow'   => esc_html__( 'Yellow', 'friday-news-toolkit' ),
					'medium_black'    => esc_html__( 'Black', 'friday-news-toolkit' ),
					'medium_gray'     => esc_html__( 'Gray', 'friday-news-toolkit' ),
					'medium_pink'     => esc_html__( 'Pink', 'friday-news-toolkit' ),
					'small_yellow'    => esc_html__( 'Yellow', 'friday-news-toolkit' ),
					'small_black'     => esc_html__( 'Black', 'friday-news-toolkit' ),
					'small_gray'      => esc_html__( 'Gray', 'friday-news-toolkit' ),
					'small_pink'      => esc_html__( 'Pink', 'friday-news-toolkit' ),
					'blockquote'      => esc_html__( 'Blockquote', 'friday-news-toolkit' )
	            )
	        ));
	    }
	}

	public function social_sharing_links_single() {
	   	?>
			<div class="social-post">
		        <ul>
		            <li><a href="https://www.facebook.com/share.php?u=<?php echo esc_url(get_permalink(get_the_id())); ?>" title="Facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
		            <li><a href="https://twitter.com/home?status=<?php echo str_replace(' ', '%20', get_the_title(get_the_id())). ':' . esc_url(get_permalink(get_the_id())); ?>" title="Twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li>
		            <li><a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink(get_the_id())); ?>" title="Google" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a></li>
		            <li><a href="https://www.pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink(get_the_id())); ?>" title="Pinterest" target="_blank" rel="nofollow"><i class="fa fa-pinterest-p"></i></a></li>
		        </ul>
		  	</div>
  		<?php
	}

	public function socials_share_cat() {
	   	?>
			<div class="ab-box">
                <div class="wrap-toggle-share">
                    <?php echo friday_news_toolkit_get_social_sharing_links(get_the_id()); ?>
                    <span class="toggle-share-icon">    ...</span>
                </div>
            </div>
  		<?php
	}
}