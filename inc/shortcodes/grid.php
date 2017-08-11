<?php

add_shortcode( 'friday_row', 'friday_news_toolkit_shortcode_row' );
add_shortcode( 'friday_col', '__return_false' );

function friday_news_toolkit_shortcode_row( $atts, $content = null ) {
    extract( shortcode_atts( array(), $atts ) );
    $items = friday_news_toolkit_get_shortcode( $content, true, array( 'friday_col' ) );
    $panels = array();
    if ( $items ) {
        foreach ( $items as $item ) {
            $panels[] = sprintf( '<div class="col-sm-%s">%s</div>', $item['atts']['size'], do_shortcode( $item['content'] ) );
        }
    }
    $output = '<div class="row clearfix">';
    $output.= implode( '', $panels );
    $output.= '</div>';
    return apply_filters( 'friday_news_toolkit_shortcode_row', $output, $atts, $content );
}