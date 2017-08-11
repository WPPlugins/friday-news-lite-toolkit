<?php

add_filter('kpb_get_widgets_list', array('FTP_Widget_Contact_Info', 'register_block'));

class FTP_Widget_Contact_Info extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_block($blocks){
        $blocks['FTP_Widget_Contact_Info'] = new FTP_Widget_Contact_Info();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-contact-widget contact-1';
		$this->widget_description = esc_html__( 'Display contact info, email, phone, address. Image background', 'friday-toolkit-plus' );
		$this->widget_id          = 'friday-toolkit-plus-contact-info';
		$this->widget_name        = esc_html__( 'Friday - Contact Info', 'friday-toolkit-plus' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'friday-toolkit-plus' )
			),            
            'address'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Address', 'friday-toolkit-plus')
            ),
			'phone'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Phone', 'friday-toolkit-plus')
            ),		            
            'email'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Email', 'friday-toolkit-plus')
            ),
            'image'  => array(
                'type'  => 'upload',
                'std'   => '',
                'mimes' => 'image',
                'label' => esc_html__( 'Upload your image:', 'friday-toolkit-plus' )
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
        ?>
            <div class="widget-content">
                <?php if($image) : ?>
                    <div class="bg-contact"><img src="<?php echo esc_url( $image ); ?>" alt=""></div>
                <?php endif; ?>
                <?php if($address || $phone || $email) : ?>
                    <div itemtype="http://schema.org/Organization" itemscope="" class="wrap-info">
                        <div class="inner">
                            <?php if($address) : ?>
                                <div class="clearfix contact-row">
                                    <span class="contact-icon"><i class="fa fa-map-marker"></i></span>
                                    <div class="wrap-contact-info">
                                        <span class="contact-title"><?php esc_html_e('Address', 'friday-toolkit-plus'); ?></span>
                                        <span class="clearfix"></span>
                                        <span class="contact-info">
                                            <?php echo wp_kses_post( $address ); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($phone) : ?>
                                <div class="clearfix contact-row">
                                    <span class="contact-icon"><i class="fa fa-phone"></i></span>
                                    <div class="wrap-contact-info"><span class="contact-title"><?php esc_html_e('Telephone', 'friday-toolkit-plus'); ?></span><span class="clearfix"></span><span class="contact-info"><span itemprop="telephone"><?php echo wp_kses_post( $phone ); ?></span></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($email) : ?>
                                <div class="clearfix contact-row">
                                    <span class="contact-icon"><i class="fa fa-envelope"></i></span>
                                    <div class="wrap-contact-info"><span class="contact-title"><?php esc_html_e('Email', 'friday-toolkit-plus'); ?></span><span class="clearfix"></span><span class="contact-info"><span itemprop="email"><a href="mailto:<?php echo esc_attr( $phone ); ?>"><?php echo wp_kses_post( $email ); ?></a></span></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>         
        <?php
		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf( '%s', $content );		
	}

}