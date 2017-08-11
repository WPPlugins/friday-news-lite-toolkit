<?php

function friday_news_toolkit_metabox_field_quote( $html, $wrap_start, $wrap_end, $field, $value ) {
    ob_start();
    $value = wp_parse_args( (array) $value, array( 'quote'=> NULL, 'author' => NULL ) );
    extract( $value );
    echo sprintf( '%s', $wrap_start );      
    ?>  
    <div class="ysg-clearfix">        
        <p class="ysg-block ysg-block-first">
            <code class="ysg-code ysg-pull-left"><?php esc_html_e( 'Message:', 'friday-news-toolkit' ); ?></code>
            <br/>
            <textarea 
                name="<?php echo esc_attr( $field['id'] ); ?>[quote]" 
                id="<?php echo esc_attr( $field['id'] ); ?>_quote" 
                value="<?php echo esc_attr( $quote ); ?>" 
                autocomplete="off"
                class="large-text"/><?php echo esc_textarea( $quote ); ?></textarea>
        </p>
        <p class="ysg-block">            
            <code class="ysg-code ysg-pull-left"><?php esc_html_e( 'Author:', 'friday-news-toolkit' ); ?></code>
            <br/>
            <input type="text"
                name="<?php echo esc_attr( $field['id'] ); ?>[author]" 
                id="<?php echo esc_attr( $field['id'] ); ?>_author" 
                value="<?php echo esc_attr( $author ); ?>" 
                autocomplete="off"
                class="ysg-pull-left medium-text"/>            
        </p>                
    </div>      
    <?php
    echo sprintf( '%s', $wrap_end );
    $html = ob_get_clean();
    return $html;
}