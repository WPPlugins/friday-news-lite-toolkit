<?php

add_action( 'widgets_init', array( 'FT_Widget_Tabs', 'register_widget' ) );

class FT_Widget_Tabs extends Kopa_Widget {

	public $kpb_group = 'post';
	public $lines = array();

	public static function register_widget() {
		register_widget( 'FT_Widget_Tabs' );
	}

	public function __construct() {
		$this->widget_cssclass    = 'kopa-tabs style-1';
		$this->widget_description = esc_html__( 'Displays a list posts in tab recent, comment, random.', 'friday-news-toolkit' );
		$this->widget_id          = 'friday-toolkit-widget-tabs';
		$this->widget_name        = esc_html__( 'Friday - Tabs', 'friday-news-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'friday-news-toolkit')
			),
			'number'  => array(
				'type'  => 'number',
				'std'   => '',
				'label' => esc_html__( 'Number of posts:', 'friday-news-toolkit')
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
			$query_array = array(
				'recent' => array(
					'posts_per_page'      => $number,
					'ignore_sticky_posts' => true
				),
				'comment' => array(
					'orderby'             => 'comment_count',
					'posts_per_page'      => $number,
					'ignore_sticky_posts' => true
				),
				'random' => array(
					'orderby'             => 'rand',
					'posts_per_page'      => $number,
					'ignore_sticky_posts' => true
				)
			);
			$title_tab = array(
				'recent'  => esc_html__( 'Recent posts', 'friday-news-toolkit' ),
				'comment' => esc_html__( 'Comment', 'friday-news-toolkit' ),
				'random'  => esc_html__( 'Random', 'friday-news-toolkit' )
			);
			$li_string      = '';
			$content_string = '';
			$li_active      = true;
			$content_active = true;
			foreach ( $query_array as  $key => $args ) {
				$random_id = rand( 10,100 );
				if ( $li_active ) {
					$li_string .= '<li class="active"><a href="#'.$random_id.'" data-toggle="tab">'.$title_tab[$key].'</a></li>';
					$li_active = false;
				} else {
					$li_string .= '<li><a href="#'.$random_id.'" data-toggle="tab">'.$title_tab[$key].'</a></li>';
				}
				if ( $content_active ) {
					$content_string .= '<div id="'.$random_id.'" class="tab-pane active"><div class="articles-list">';
					$content_active = false;
				} else {
					$content_string .= '<div id="'.$random_id.'" class="tab-pane"><div class="articles-list">';
				}
				
				$result_set = new WP_Query( $args );
				$index      = true; 
				$next       = true;
				$count_post = count( $result_set->posts );
				$count      = 0;
				$index_ul   = 0;
				if ( $result_set->have_posts() ) : while ( $result_set->have_posts() ) : $result_set->the_post();
					if ( $index ) :
						$content_string .= '<div class="entry-last">
                          						<div class="entry-item">';
                          						if ( has_post_thumbnail() ) : 
                        $content_string .=  		'<div class="entry-thumb">
                                                    	<div class="thumb-icon image">
                                                      		<div class="inner">'.friday_news_lite_get_icon_by_post_format().'</div>
                                                    	</div>
                                                    	<div class="ab-box">
	                                                      	<div class="wrap-toggle-share">
		                                                        '.friday_news_toolkit_get_social_sharing_links( get_the_id() ).'
		                                                        <span class="toggle-share-icon">	...</span>
	                                                      	</div>
                                                    	</div>
	                                                    <a href="'.get_permalink().'">
	                                                    '.get_the_post_thumbnail( get_the_id(), 'friday_news-widget-345x220' ).'
	                                                    </a>
	                            					</div>';
	                            				endif; 
	                    $content_string .=      friday_news_lite_get_first_cat( get_the_id(), 'categories' ).'
	                                                <h5 class="entry-title st-8"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>
	                         					</div>
                        					</div>';
                    	$index = false; $count++; 
                    else :
                        	if ( $next ) :
	                        	$content_string .= '<div class="entry-older"><ul class="rs-ul">';
	                        	$next = false; 
	                        endif;
                                $content_string .= '<li>';
                                if ( $index_ul == 0 ) {
                              		$content_string .= '<div class="entry-item entry-item-firts">';
                                } else {
                                	$content_string .= '<div class="entry-item entry-item-other">';
                                }
                                $content_string .= '<h5 class="entry-title st-9"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>
                              		</div>
                            	</li>';
				            if ( $count == $count_post - 1 ) :
				                $content_string .= '</ul></div>';
				            endif;
				            $count++; 
				            $index_ul++;
                   	endif;
				endwhile; endif;
				wp_reset_postdata();
				$content_string .= '</div></div>';
			}
		?>
		    <ul class="nav nav-tabs">
		        <?php echo sprintf( '%s', $li_string ); ?>
		    </ul>
		    <div class="tab-content">
		        <?php echo sprintf( '%s', $content_string ); ?>
		    </div>
		<?php
		echo  wp_kses_post( $after_widget );
		$content = ob_get_clean();
		echo sprintf( '%s', $content );
	}
}