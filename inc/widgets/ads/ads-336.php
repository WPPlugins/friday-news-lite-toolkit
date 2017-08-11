<?php

add_action( 'widgets_init', array( 'FT_Widget_Ads_336', 'register_widget' ) );

class FT_Widget_Ads_336 extends Kopa_Widget {

	public $kpb_group = 'Ads';
	public $lines     = array();

	public static function register_widget() {
		register_widget( 'FT_Widget_Ads_336' );
	}

	public function __construct() {
		$this->widget_cssclass    = 'widget kopa-ads-widget ads-2';
		$this->widget_description = esc_html__( 'Display your image ads size 336x280.', 'friday-news-toolkit' );
		$this->widget_id          = 'friday-toolkit-widget-ads-336';
		$this->widget_name        = esc_html__( 'Friday - Ads 336x280', 'friday-news-toolkit' );
		
		$this->settings           = array(			
			'url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'URL:', 'friday-news-toolkit')
			),
			'target'  => array(
				'type'  => 'select',
				'std'   => '_blank',
				'label' => esc_html__( 'Target:', 'friday-news-toolkit'),
				'options' => array(
					'_self'  => esc_html__('Open in current tab', 'friday-news-toolkit'),
					'_blank' => esc_html__('Open in new tab', 'friday-news-toolkit')
				)
			),				
			'image'  => array(
				'type'  => 'upload',
				'std'   => '',
				'mimes' => 'image',
				'label' => esc_html__( 'Upload your image:', 'friday-news-toolkit' )
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
		?>
       	<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>"><img src="<?php echo esc_url( $image ); ?>" alt=""></a>
		<?php
		echo  wp_kses_post( $after_widget );
		$content = ob_get_clean();
		echo wp_kses_post( $content );
	}
}