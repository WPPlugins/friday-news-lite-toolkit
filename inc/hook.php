<?php
function friday_news_toolkit_meta_box_wrap_start( $wrap, $value, $loop_index ) {
	if( 0 == $loop_index ) {
		$wrap = '<div class="fd-metabox-wrap fd-metabox-wrap-first fd-row">';
	} else {
		$wrap = '<div class="fd-metabox-wrap fd-row">';	
	}
	if ( $value['title'] ) {
		$wrap .= '<div class="fd-col-xs-3">';
		$wrap .= esc_html($value['title']);
		$wrap .= '</div>';
		$wrap .= '<div class="fd-col-xs-9">';
	} else {
		$wrap .= '<div class="fd-col-xs-12">';
	}
	return $wrap;
}

function friday_news_toolkit_meta_box_wrap_end( $wrap, $value, $loop_index ) {
	$wrap = '';
	if ( $value['desc'] ) {
		$wrap .= '<p class="fd-help">'. $value['desc'] . '</p>';		
	}
	$wrap .= '</div>';
	$wrap .= '</div>';
	return $wrap;
}

function friday_news_toolkit_register_metabox_post_featured() {
    $post_type = array('post');
    $args = array(
		'id'       => 'friday-post-options-metabox',
		'title'    => esc_html__( 'Featured content', 'friday-news-toolkit' ),
		'desc'     => '',
		'pages'    => $post_type,
		'context'  => 'normal',
		'priority' => 'low',
		'fields'   => array(    
			array(
				'title' => esc_html__( 'Show / Hide featured in single.', 'friday-news-toolkit' ),
				'type'  => 'select',
				'id'    => 'friday_featured_status',
				'default' => 'show',
				'options' => array(
					'show'   => esc_html__( 'Show', 'friday-news-toolkit' ),
					'hide'   => esc_html__( 'Hide', 'friday-news-toolkit' )
				)
            ),                     
            array(
				'title' => esc_html__( 'Gallery:', 'friday-news-toolkit' ),
				'type'  => 'gallery',
				'id'    => 'friday_gallery',
				'desc'  => esc_html__( 'This option only apply for post-format "Gallery".', 'friday-news-toolkit' )
            ),
            array(
				'title' => esc_html__( 'Quote:', 'friday-news-toolkit' ),
				'type'  => 'quote',
				'id'    => 'friday_quote',
				'desc'  => esc_html__( 'This option only apply for post-format "Quote".', 'friday-news-toolkit' )
            ),
            array(
				'title' => esc_html__( 'Custom:', 'friday-news-toolkit' ),
				'type'  => 'textarea',
				'id'    => 'friday_custom',
				'desc'  => esc_html__( 'Enter custom content as shortcode or custom HTML, ...', 'friday-news-toolkit' )
            )                
        )
    );
    kopa_register_metabox( $args );	
}

function friday_news_toolkit_youtube_settings( $code ) {
	if ( strpos( $code, 'youtu.be' ) !== false || strpos( $code, 'youtube.com' ) !== false ) {
		return preg_replace( "@src=(['\"])?([^'\">\s]*)@", "src=$1$2&autohide=1&showinfo=0&hd=1&rel=0&theme=light&controls=2", $code );		
	}
	return $code;
}

function friday_news_toolkit_excerpt_more( $more ) {
	return '..';
}

function friday_news_toolkit_make_video_shortcode_responsive( $html ) {
    if ( ! empty( $html ) ) {
        $out = preg_replace( '/(<[^>]+) style=".*?"/i', '$1', $html );
        $out = preg_replace( '/(width|height)="\d*"\s/', "", $out );
    }
    return $out;	
}

function friday_news_toolkit_add_social_field( $profile_fields ) {
	$profile_fields['twitter']   = esc_html__('Twitter URL', 'friday-news-toolkit' );
	$profile_fields['facebook']  = esc_html__('Facebook URL', 'friday-news-toolkit' );
	$profile_fields['gplus']     = esc_html__('Google+ URL', 'friday-news-toolkit' );
	$profile_fields['pinterest'] = esc_html__('Pinterest URL', 'friday-news-toolkit' );
	return $profile_fields;
}