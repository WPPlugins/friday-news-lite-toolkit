<?php

function friday_news_toolkit_get_post_widget_args() {
	
	$all_cats = get_categories();
	$categories = array( '' => esc_html__( '-- none --', 'friday-news-toolkit' ) );
	foreach ( $all_cats as $cat ) {
		$categories[ $cat->slug ] = $cat->name;
	}

	$all_tags = get_tags();
	$tags = array( '' => esc_html__( '-- none --', 'friday-news-toolkit' ) );
	foreach( $all_tags as $tag ) {
		$tags[ $tag->slug ] = $tag->name;
	}

	return array(
		'title'  => array(
			'type'  => 'text',
			'std'   => '',
			'label' => esc_html__( 'Title:', 'friday-news-toolkit' )
		),
		'categories' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Categories:', 'friday-news-toolkit' ),
			'options' => $categories,
			'size'    => '5'
		),
		'relation'    => array(
			'type'    => 'select',
			'label'   => esc_html__( 'Relation:', 'friday-news-toolkit' ),
			'std'     => 'OR',
			'options' => array(
				'AND' => esc_html__( 'AND', 'friday-news-toolkit' ),
				'OR'  => esc_html__( 'OR', 'friday-news-toolkit' )
			)
		),
		'tags' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Tags:', 'friday-news-toolkit' ),
			'options' => $tags,
			'size'    => '5'
		),
		'order' => array(
			'type'  => 'select',
			'std'   => 'DESC',
			'label' => esc_html__( 'Order:', 'friday-news-toolkit' ),
			'options' => array(
				'ASC'  => esc_html__( 'ASC', 'friday-news-toolkit' ),
				'DESC' => esc_html__( 'DESC', 'friday-news-toolkit' )
			)
		),
		'orderby' => array(
			'type'  => 'select',
			'std'   => 'date',
			'label' => esc_html__( 'Orderby:', 'friday-news-toolkit' ),
			'options' => array(
				'date'          => esc_html__( 'Date', 'friday-news-toolkit' ),
				'rand'          => esc_html__( 'Random', 'friday-news-toolkit' ),
				'comment_count' => esc_html__( 'Number of comments', 'friday-news-toolkit' )
			)
		),
		'number' => array(
			'type'    => 'number',
			'std'     => '5',
			'label'   => esc_html__( 'Number of posts:', 'friday-news-toolkit' ),
			'min'     => '1'
		)
	);
}

function friday_news_toolkit_get_post_widget_query( $instance ) {
	$query = array(
		'post_type'           => 'post',
		'posts_per_page'      => $instance['number'],
		'order'               => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
		'orderby'             => $instance['orderby'],
		'ignore_sticky_posts' => true
	);

	if ( $instance['categories'] ) {		
		if ( $instance['categories'][0] == '' )
			unset( $instance['categories'][0] );

		if ( $instance['categories'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $instance['categories'],
			);
		}
	}

	if ( $instance['tags'] ) {
		if ( $instance['tags'][0] == '')
			unset( $instance['tags'][0] );

		if ( $instance['tags'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'post_tag',
				'field'    => 'slug',
				'terms'    => $instance['tags'],
			);
		}
	}

	if ( isset( $query['tax_query'] ) && count( $query['tax_query'] ) === 2 ) {
		$query['tax_query']['relation'] = $instance['relation'];
	}

	return apply_filters( 'friday_news_toolkit_get_post_widget_query', $query );
}

function friday_news_toolkit_get_shortcode( $content, $enable_multi = false, $shortcodes = array() ) {
    
	$codes         = array();
	$regex_matches = '';
	$regex_pattern = get_shortcode_regex();
    
    preg_match_all( '/' . $regex_pattern . '/s', $content, $regex_matches );

    foreach ( $regex_matches[0] as $shortcode ) {
        $regex_matches_new = '';
        preg_match( '/' . $regex_pattern . '/s', $shortcode, $regex_matches_new );

        if ( in_array( $regex_matches_new[2], $shortcodes ) ) :
            $codes[] = array(
				'shortcode' => $regex_matches_new[0],
				'type'      => $regex_matches_new[2],
				'content'   => $regex_matches_new[5],
				'atts'      => shortcode_parse_atts($regex_matches_new[3])
            );

            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $codes;
}

function friday_news_toolkit_convert_links( $status, $targetBlank = true, $linkMaxLen = 250 ) {
 
    // the target
    $target=$targetBlank ? " target=\"_blank\" " : "";
     
    // convert link to url                              
    $status = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i', '<a href="\0" target="_blank">\0</a>', $status );
     
    // convert @ to follow
    $status = preg_replace( "/(@([_a-z0-9\-]+))/i", "<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>", $status );
     
    // convert # to search
   	$status = preg_replace( "/(#([_a-z0-9\-]+))/i", "<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>", $status );
     
    // return the status
    return $status;
}

function friday_news_toolkit_get_social_sharing_links( $id = null ) {
	    ob_start();
	    ?>  
	        <ul class="rs-ul show-social">
	            <li><a target="_blank" rel="nofollow" href="https://www.facebook.com/share.php?u=<?php echo esc_url(get_permalink($id)); ?>"><i class="fa fa-facebook"></i></a></li>
	            <li><a target="_blank" rel="nofollow" href="https://twitter.com/home?status=<?php echo str_replace(' ', '%20', get_the_title($id)). ':' . esc_url(get_permalink($id)); ?>"><i class="fa fa-twitter"></i></a></li>
	            <li><a target="_blank" rel="nofollow" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink($id)); ?>"><i class="fa fa-google-plus"></i></a></li>
	        </ul>
	        
	    <?php
	    $content = ob_get_clean();
	    return $content;
}