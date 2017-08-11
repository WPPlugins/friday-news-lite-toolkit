<?php

add_action( 'widgets_init', array( 'FT_Widget_Follow_Us', 'register_widget' ) );

class FT_Widget_Follow_Us extends Kopa_Widget {

	public $kpb_group = 'social';
	public $lines = array();

	public static function register_widget() {
		register_widget( 'FT_Widget_Follow_Us' );
	}

	public function __construct() {
		$this->widget_cssclass    = 'follow-us-widget';
		$this->widget_description = esc_html__( 'Displays a list of socials.', 'friday-news-toolkit' );
		$this->widget_id          = 'friday_news_toolkit_widget_follow_us';
		$this->widget_name        = esc_html__( 'Friday - Follow Us', 'friday-news-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'friday-news-toolkit')
			),
			'facebook_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Facebook URL:', 'friday-news-toolkit')
			),
			'pinterest_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Pinterest URL:', 'friday-news-toolkit')
			),
			'instagram_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Instagram URL:', 'friday-news-toolkit')
			),
			'twitter_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Twitter URL:', 'friday-news-toolkit')
			),
			'google_plus_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Gooogle+ URL:', 'friday-news-toolkit')
			),
			'flickr_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Flickr URL:', 'friday-news-toolkit')
			),
			'youtube_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Youtube URL:', 'friday-news-toolkit')
			),
			'email'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Email URL:', 'friday-news-toolkit')
			)
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {	
		ob_start();
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
		extract( $instance );
		echo wp_kses_post( $before_widget );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( $title ) :
			echo wp_kses_post( $before_title.$title.$after_title );
		endif; 
		?>
		<div class="widget-content">
			<ul class="rs-ul">
				<?php if ( $facebook_url ) : ?>
		    	   <li><a rel="nofollow" href="<?php echo esc_url( $facebook_url ); ?>"><?php esc_html_e('Facebook', 'friday-news-toolkit'); ?></a></li>
		    	<?php endif; ?>

		    	<?php if ( $pinterest_url ) : ?>
	    	   		<li><a rel="nofollow" href="<?php echo esc_url( $pinterest_url ); ?>"><?php esc_html_e('Pinterest', 'friday-news-toolkit'); ?></a></li>
	    	   	<?php endif; ?>

	    	   	<?php if ( $instagram_url ) : ?>
	    	   		<li><a rel="nofollow" href="<?php echo esc_url( $instagram_url ); ?>"><?php esc_html_e('Instagram', 'friday-news-toolkit'); ?></a></li>
	    	   	<?php endif; ?>

	    	   	<?php if ( $twitter_url ) : ?>
	    	   		<li><a rel="nofollow" href="<?php echo esc_url( $twitter_url ); ?>"><?php esc_html_e('Twitter', 'friday-news-toolkit'); ?></a></li>
	    	   	<?php endif; ?>

	    	   	<?php if ( $google_plus_url ) : ?>
	    	   		<li><a rel="nofollow" href="<?php echo esc_url( $google_plus_url ); ?>"><?php esc_html_e('Google+', 'friday-news-toolkit'); ?></a></li>
	    	   	<?php endif; ?>

	    	   	<?php if ( $flickr_url ) : ?>
	    	   		<li><a rel="nofollow" href="<?php echo esc_url( $flickr_url ); ?>"><?php esc_html_e('Flickr', 'friday-news-toolkit'); ?></a></li>
	    	   	<?php endif; ?>

	    	   	<?php if ( $youtube_url ) : ?>
	    	   		<li><a rel="nofollow" href="<?php echo esc_url( $youtube_url ); ?>"><?php esc_html_e('Youtube', 'friday-news-toolkit'); ?></a></li>
	    	   	<?php endif; ?>

	    	   	<?php if ( $email ) : ?>
	    	   		<li><a rel="nofollow" href="mailto:<?php esc_attr( $email ); ?>"><?php esc_html_e('Email', 'friday-news-toolkit'); ?></a></li>
	    	   	<?php endif; ?>
	    	</ul>
		</div>
		<?php
		echo wp_kses_post( $after_widget );
		$content = ob_get_clean();
		echo wp_kses_post( $content );
	}
}