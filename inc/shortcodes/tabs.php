<?php

add_shortcode( 'friday_tabs', 'friday_news_toolkit_shortcode_tabs' );
add_shortcode( 'friday_tab', '__return_false' );

function friday_news_toolkit_shortcode_tabs( $atts, $content = null ) {
    extract( shortcode_atts( array( 'class' => 'kopa-tabs style-1', 'type' => ''), $atts ) );
    switch ( $type ) {
        case 'background':            
            $class = 'kopa-tabs style-2';
            break;
        default:
            $class = 'kopa-tabs style-1';
            break;
    }
    $items  = friday_news_toolkit_get_shortcode( $content, true, array( 'friday_tab' ) );
    $navs   = array();
    $panels = array();
    if ( $items ) {
        $active = 'active';
        foreach ( $items as $item ) {
            $title    = $item['atts']['title'];
            $item_id  = 'tab-' . wp_generate_password( 4, false, false );
            $navs[]   = sprintf( '<li class="%s"><a href="#%s" data-toggle="tab">%s</a></li>', $active, $item_id, do_shortcode( $title ) );
            $panels[] = sprintf( '<div class="tab-pane %s" id="%s">%s</div>', $active, $item_id, do_shortcode( $item['content'] ) );
            $active   = '';
        }
    }
    $output = sprintf( '<div class="%s">', $class );
    $output .= '<ul class="nav nav-tabs" >';
    $output .= implode( '', $navs );
    $output .= '</ul>';
    $output .= '<div class="tab-content">';
    $output .= implode( '', $panels );
    $output .= '</div>';
    $output .= '</div>';
    return apply_filters( 'friday_news_toolkit_shortcode_tabs', $output, $atts, $content );
}