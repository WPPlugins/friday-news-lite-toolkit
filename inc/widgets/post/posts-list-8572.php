<?php

add_action( 'widgets_init', array( 'FT_Widget_Posts_List_8572', 'register_widget' ) );
	
class FT_Widget_Posts_List_8572 extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_widget() {
       register_widget( 'FT_Widget_Posts_List_8572' );
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'kopa-most-comments-widget';
		$this->widget_description = esc_html__( 'Display posts list thumbnail size 85x72 and title.', 'friday-news-toolkit' );
		$this->widget_id          = 'friday-toolkit-widget-posts-list-8572';
		$this->widget_name        = esc_html__( 'Friday - Posts List (85x72)', 'friday-news-toolkit' );
		$this->settings 		  = friday_news_toolkit_get_post_widget_args();		

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
			echo wp_kses_post( $before_title . $title .$after_title );	
		endif; 
		$query      = friday_news_toolkit_get_post_widget_query( $instance );
		$result_set = new WP_Query( $query );
		if ( $result_set->have_posts() ) :			
			?>
			<div class="widget-content">
				<ul>
					<?php
					while ( $result_set->have_posts() ): $result_set->the_post();
						?>
							<li>
	                           	<article class="entry-item">
		                           	<?php if ( has_post_thumbnail() ) : ?>
		                              	<div class="entry-thumb">
		                              		<a href="<?php the_permalink(); ?>">
		                              			<?php the_post_thumbnail( 'friday_news-widget-85x72' ); ?>
		                              		</a>
		                              	</div>
		                            <?php endif; ?>
	                              	<div class="entry-box">
	                                 	<h6 class="entry-title st-10"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
	                              	</div>
	                           	</article>
	                        </li>
						<?php
					endwhile;
					?>
				</ul>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
		$content = ob_get_clean();
		echo sprintf( '%s', $content );
	}
}