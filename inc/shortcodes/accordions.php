<?php

add_shortcode( 'friday_accordions', 'friday_news_toolkit_shortcode_accordions' );
add_shortcode( 'friday_accordion', '__return_false' );

function friday_news_toolkit_shortcode_accordions( $atts, $content = null ) {
    extract( shortcode_atts( array(), $atts ) );
    $items  = friday_news_toolkit_get_shortcode( $content, true, array( 'friday_accordion' ) );
    $output = '';
    if ( $items ) {
        $parent_id = 'accordions-' . wp_generate_password( 4, false, false );
        $is_first  = TRUE;
        $output    .= sprintf( '<div class="kopa-accordion" id="%s">', $parent_id );
        foreach ( $items as $item ) {
            $child_id = 'accordion-' . wp_generate_password( 4, false, false );
            $title    = $item['atts']['title'];
            if ( $is_first ) {
                $output .= '<div class="title active"><span class="icon"><i class="fa fa-plus"></i></span>';
            } else {
                $output .= '<div class="title"><span class="icon"><i class="fa fa-plus"></i></span>';
            }
            $output .= sprintf( '<span class="title-content">%s</span>', $title );
            $output .= '</div>';
            if ( $is_first ) {
                $output .= '<div class="content block-show">';
            } else {
                $output .= '<div class="content">';
            }
            $output .= '<p>'.do_shortcode( $item['content'] ).'</p>';
            $output .= '</div>';
            $is_first = FALSE;
        }
    }
    $output.= '</div>';
    return apply_filters( 'friday_news_toolkit_shortcode_accordions', $output, $atts, $content );
}