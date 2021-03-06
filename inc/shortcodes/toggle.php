<?php

add_shortcode( 'friday_toggles', 'friday_news_toolkit_shortcode_toggles' );
add_shortcode( 'friday_toggle', '__return_false' );

function friday_news_toolkit_shortcode_toggles( $atts, $content = null ) {
    extract( shortcode_atts( array(), $atts ) );
    $items  = friday_news_toolkit_get_shortcode( $content, true, array( 'friday_toggle' ) );
    $output = '';
    if ( $items ) {        
        $is_first = TRUE;
        $parent_id = 'toggles-' . wp_generate_password( 4, false, false );
        $output    .= sprintf( '<div class="kopa-toggle" id="%s">', $parent_id );
        foreach ( $items as $item ) {        
            $title    = $item['atts']['title'];
            if ( $is_first ) {
                $output .= '<div class="title active">';
            } else {
                $output .= '<div class="title">';
            }          
            $output .= sprintf( '<span class="title-content">%s</span><span class="icon"><i class="fa fa-plus"></i></span>', $title );
            $output .= '</div>';
            if ( $is_first ) {
                $output.= '<div class="content block-show">';
            } else {
                $output.= '<div class="content">';
            }
            $output   .= '<p>'.do_shortcode( $item['content'] ).'</p>';
            $output   .= '</div>';
            $is_first = FALSE;
        }
        $output .= '</div>';
    }
    return apply_filters( 'friday_news_toolkit_shortcode_toggles', $output, $atts, $content );
}