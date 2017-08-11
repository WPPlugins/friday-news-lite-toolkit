<?php

add_shortcode( 'friday_blockquote', 'friday_news_toolkit_shortcode_blockquote' );

function friday_news_toolkit_shortcode_blockquote( $atts, $content = null ) {
    extract( shortcode_atts( array( 'class' => '', 'title' => '' ), $atts ) );
    $output = NULL;
    if ( !empty( $content ) ) {
        $output = sprintf( '<blockquote class="%s">%s', $atts['class'], $content );
        if ( isset( $atts['title'] ) ) {
            $output.= sprintf( '<span class="quote">%s</span>', $atts['title'] );
        }
        $output.= '</blockquote>';
    }
    return apply_filters( 'friday_news_toolkit_shortcode_blockquote', force_balance_tags( $output ), $atts, $content );
}