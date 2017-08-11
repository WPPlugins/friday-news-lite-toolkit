<?php

add_action( 'widgets_init', array( 'FT_Widget_Tags', 'register_widget' ) );

class FT_Widget_Tags extends Kopa_Widget {

	public $kpb_group = 'post';
	public $lines = array();

	public static function register_widget() {
		register_widget( 'FT_Widget_Tags' );
	}

	public function __construct() {
		$this->widget_cssclass    = 'widget_tag_cloud';
		$this->widget_description = esc_html__( 'Displays a list of tags.', 'friday-news-toolkit' );
		$this->widget_id          = 'friday-toolkit-widget-tags';
		$this->widget_name        = esc_html__( 'Friday - Tags', 'friday-news-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'friday-news-toolkit')
			),
			'number'  => array(
				'type'  => 'number',
				'std'   => '',
				'label' => esc_html__( 'Number of tags:', 'friday-news-toolkit')
			),
			'exclude'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Exclude no tags:', 'friday-news-toolkit')
			),
			'orderby'  => array(
				'type'  => 'select',
				'std'   => 'name',
				'label' => esc_html__( 'Order by:', 'friday-news-toolkit'),
				'options' => array(
					'name'  => esc_html__('Name', 'friday-news-toolkit'),
					'count' => esc_html__('Count', 'friday-news-toolkit')
				)
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
		echo '<div class="tagcloud">';
			$args = array(
				'smallest' => 12, 
				'largest'  => 12,
				'unit'     => 'px', 
				'number'   => $number,
				'orderby'  => $orderby,
				'exclude'  => $exclude
			);
			wp_tag_cloud( $args );
		echo '</div>';
		echo  wp_kses_post( $after_widget );
		$content = ob_get_clean();
		echo sprintf( '%s', $content );
	}
}