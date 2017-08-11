<?php

add_shortcode( 'friday_button', 'friday_news_toolkit_shortcode_button' );

function friday_news_toolkit_shortcode_button( $atts, $content = null ) {
    extract( shortcode_atts( array( 'class' => '', 'link' => '', 'target' => '' ), $atts ) );
    $link    = isset( $atts['link'] ) ? $atts['link'] : '#';
    $class   = isset( $atts['class'] ) ? $atts['class'] : 'kopa-button';
    $target  = isset( $atts['target'] ) ? $atts['target'] : '';    
    $classes = explode( ' ', $class );
    if ( ! $target ) {
        $target = '_self';
    }
    $output = sprintf( '<a href="%s" class="%s" target="%s">%s</a>', $link, $class, $target, do_shortcode( $content ) );
    return apply_filters( 'friday_news_toolkit_shortcode_button', $output );
}