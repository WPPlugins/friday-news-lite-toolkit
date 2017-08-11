<?php

add_action( 'widgets_init', array( 'FT_Widget_Featured_Post', 'register_widget' ) );

class FT_Widget_Featured_Post extends Kopa_Widget {

	public $kpb_group = 'post';

	public static function register_widget() {
		register_widget( 'FT_Widget_Featured_Post' );
	}

	public function __construct() {
		$this->widget_cssclass    = 'widget kopa-articles-list-widget articles-list-1';
		$this->widget_description = esc_html__( 'Display a single post with big thumbnail and excerpt. Widget not support title.', 'friday-news-toolkit' );
		$this->widget_id          = 'friday-toolkit-featured-post';
		$this->widget_name        = esc_html__( 'Friday - Featured Post', 'friday-news-toolkit' );

		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'friday-news-toolkit' )
			)
		);
		$this->settings['excerpt_length'] = array(
			'type'  => 'number',
			'std'   => 20,
			'label' => esc_html__( 'Excerpt length:', 'friday-news-toolkit' ),
			'desc'  => esc_html__( 'Enter 0 to hide the excerpt.', 'friday-news-toolkit' )
		);

		$posts = get_posts(array(
			'posts_per_page'   => -1,
			'post_type'        => 'post'
		));

		$cbo_options = array();
		if ( $posts ) {			
			foreach ( $posts as $post ) {						
				$cbo_options[ $post->post_name ] = $post->post_title;
			}
		}		

		$this->settings['post_name'] = array(
			'type'    => 'select',
			'label'   => esc_html__( 'Select a post', 'friday-news-toolkit' ),
			'std'     => '',
			'options' => $cbo_options
		);
		
		wp_reset_query();

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		ob_start();
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );		
		echo wp_kses_post( $before_widget );
		$result_set = new WP_Query(array(
			'posts_per_page' => 1,
			'post_type'      => 'post',
			'name'           => $post_name
		));		

		if ( $result_set->have_posts() ) :
            while ( $result_set->have_posts() ): $result_set->the_post();	                              
                ?>
					<div class="widget-content">
	                    <div class="entry-item">
	                    	<?php if ( has_post_thumbnail() ) : ?>
		                        <div class="entry-thumb">
		                            <div class="inner">
		                           		<?php echo friday_news_lite_get_first_cat( get_the_id(), 'categories' ); ?>
	                                    <a href="<?php the_permalink(); ?>">
	                                        <?php the_post_thumbnail( 'friday_news-widget-blog3-730x438' ); ?>
	                                    </a>
		                                <div class="thumb-icon image">
		                                    <div class="inner">
		                                    	<?php echo friday_news_lite_get_icon_by_post_format(); ?>
		                                    </div>
		                                </div>
		                                <div class="ab-box">
		                                    <div class="wrap-toggle-share">
		                                        <?php echo friday_news_toolkit_get_social_sharing_links( get_the_id() ); ?>
		                                        <span class="toggle-share-icon">	...</span>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
	                        <?php endif; ?>
	                        <div class="entry-box">
	                            <div class="inner">
	                                <h2 class="entry-title st-2">
	                                	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                                </h2>
	                                <?php
	                                	$excerpt_tmp = get_the_excerpt();
		                                if ( (int) $excerpt_length ) { 
											$excerpt = wp_trim_words( strip_shortcodes( $excerpt_tmp ), $excerpt_length, '' );
											echo ( $excerpt ) ? apply_filters( 'the_content', $excerpt ) : '';
		                                }
	                                ?>
	                                <div class="entry-info">
	                                	<span class="entry-author"><?php esc_html_e( 'By', 'friday-news-toolkit'); the_author_posts_link(); ?></span>
	                                	<span class="divier"></span>
	                                	<span class="entry-time"><?php echo get_the_date(); ?></span>
	                                    <div class="clearfix"></div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>         
                <?php
            endwhile;
		endif;
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
		$content = ob_get_clean();
		echo sprintf( '%s', $content );
	}
}
