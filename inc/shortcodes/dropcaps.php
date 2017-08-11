<?php

add_shortcode( 'friday_dropcap', 'friday_news_toolkit_shortcode_dropcap' );

function friday_news_toolkit_shortcode_dropcap( $atts, $content = null ) {
    if ( $content ) {
        extract( shortcode_atts( array( 'class' => '' ), $atts ) );
        $class = isset( $atts['class'] ) ? $atts['class'] : 'kopa-dropcap style-1';
        return apply_filters( 'friday_news_toolkit_shortcode_dropcap', sprintf( '<span class="%s">%s</span>', $class, $content ), $atts, $content );
    }
}