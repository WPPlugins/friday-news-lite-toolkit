<?php

function friday_news_toolkit_metabox_field_gallery( $html, $wrap_start, $wrap_end, $field, $value ) {
    ob_start();
    echo sprintf( '%s', $wrap_start );        
    ?>  
    <div class="fd-gallery-box">
        <input 
        class="medium-text fd-gallery" 
        type="text" 
        name="<?php echo esc_attr($field['id']);?>" 
        id="<?php echo esc_attr($field['id']);?>" 
        value="<?php echo esc_attr($value);?>"         
        autocomplete="off">

        <a href="#" class="fd-gallery-config button button-secondary">
            <?php esc_html_e( 'Config', 'friday-news-toolkit' ); ?>
        </a>
    </div>
    <?php
    echo sprintf( '%s', $wrap_end );
    $html = ob_get_clean();
    return $html;
}