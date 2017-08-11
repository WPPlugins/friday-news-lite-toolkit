<?php

add_filter('kpb_get_widgets_list', array('FTP_Widget_Contact_Form', 'register_block'));

class FTP_Widget_Contact_Form extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_block($blocks){
        $blocks['FTP_Widget_Contact_Form'] = new FTP_Widget_Contact_Form();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-contact-widget contact-2';
		$this->widget_description = esc_html__( 'Display contact form.', 'friday-toolkit-plus' );
		$this->widget_id          = 'friday-toolkit-plus-contact-form';
		$this->widget_name        = esc_html__( 'Friday - Contact Form', 'friday-toolkit-plus' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'friday-toolkit-plus' )
			),            
            'desc'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 10,
                'label' => esc_html__('Description', 'friday-toolkit-plus')
            )
		);	

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		ob_start();

		extract( $args );
		
        $instance = wp_parse_args((array) $instance, $this->get_default_instance());
		
        extract( $instance );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		echo wp_kses_post( $before_widget );
        if($title) :
        echo wp_kses_post( $before_title . $title .$after_title ); 
        endif;
        ?>
            <?php if($desc) : ?>
                <div class="description">
                    <p><?php echo wp_kses_post( $desc ); ?></p>
                </div>
            <?php endif; ?>
            <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" novalidate="novalidate" class="contact-form">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h6 class="contact-label"><?php esc_html_e( 'Your Name', 'friday-toolkit-plus' ); ?><span class="require">*</span></h6>
                        <input id="contact_name" type="text" placeholder="<?php _e('Name', 'friday-toolkit-plus'); ?>"  name="name" class="valid">
                        <h6 class="contact-label"><?php esc_html_e( 'Your Email', 'friday-toolkit-plus' ); ?><span class="require">*</span></h6>
                        <input id="contact_email" type="text" placeholder="<?php _e('Email', 'friday-toolkit-plus'); ?>"  name="email" class="valid">
                        <h6 class="contact-label"><?php esc_html_e( 'Subject', 'friday-toolkit-plus' ); ?><span class="require">*</span></h6>
                        <input type="text" placeholder="<?php esc_html_e('Subject', 'friday-toolkit-plus'); ?>" name="subject">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h6 class="contact-label"><?php esc_html_e( 'Your Message', 'friday-toolkit-plus' ); ?><span class="require">*</span></h6>
                        <textarea id="contact_message" name="message" placeholder="<?php esc_html_e('Message', 'friday-toolkit-plus'); ?>" class="valid"></textarea>
                        <button id="submit-contact" type="submit" value=""><?php esc_html_e( 'send message', 'friday-toolkit-plus' ); ?><i class="fa fa-paper-plane"></i></button>
                        <div id="response">
                        <input type="hidden" name="action" value="friday_toolkit_plus_send_contact_widget">
                        <?php echo wp_nonce_field('friday_toolkit_plus_send_contact_widget', 'ajax_nonce_friday_toolkit_plus_send_contact_widget', true, false); ?>
                    </div>
                </div>
                <!-- /.row-->
            </form>
        <?php
		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf( '%s', $content );		
	}

}