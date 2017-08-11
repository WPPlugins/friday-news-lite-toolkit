<?php

add_action( 'widgets_init', array( 'FT_Widget_Tweets_List', 'register_widget' ) );

class FT_Widget_Tweets_List extends Kopa_Widget {

	public $kpb_group = 'social';

	public static function register_widget(){
		register_widget( 'FT_Widget_Tweets_List' );
	}

	public function __construct() {
		$this->widget_cssclass    = 'kopa-twitter-widget';
		$this->widget_description = esc_html__( 'Display your latest tweets by un-order list.', 'friday-news-toolkit' );
		$this->widget_id          = 'friday_news_toolkit_tweets_list';
		$this->widget_name        = esc_html__( 'Friday - Tweets List', 'friday-news-toolkit' );
		
		$this->settings           = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => 'Latest Tweets',
				'label' => esc_html__( 'Title:', 'friday-news-toolkit')
			),			
			'screen_name'  => array(
                'type'  => 'text',
                'std'   => 'wordPress',
                'label' => esc_html__( 'Username:', 'friday-news-toolkit' )
            ),
			'count'  => array(
				'type'  => 'text',
				'std'   => 3,
				'label' => esc_html__( 'Number of tweets:', 'friday-news-toolkit' )
			),		
            'consumer_key'  => array(
                'type'  => 'text',
                'std'   => 'p7JWh4Ak5kSIj1TKJLU6XPQXa',
                'label' => esc_html__( 'Consumer key:', 'friday-news-toolkit' )
            ),
            'consumer_secret'  => array(
                'type'  => 'text',
                'std'   => '8F7MNgaWkAC6MaVVvISHjN8bJMvG0nTaCgW7BVEGmWNrbyMab3',
                'label' => esc_html__( 'Consumer secret:', 'friday-news-toolkit' )
            ),
            'oauth_access_token'  => array(
                'type'  => 'text',
                'std'   => '2494768374-NkUQc41vl8Wox02jKoMUl6s2ID7ttM2InA4jl75',
                'label' => esc_html__( 'Oauth access token:', 'friday-news-toolkit' )
            ),
            'oauth_access_token_secret'  => array(
                'type'  => 'text',
                'std'   => 'L5bchhd4HllnKn6lLvt8AT2vza2w7ezs3CfnJJTayEmzm',
                'label' => esc_html__( 'Oauth access token secret:', 'friday-news-toolkit' )
            )
        );

		parent::__construct();
	}

	public function widget( $args, $instance ) {	
		ob_start();
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
		extract( $instance );
		echo wp_kses_post( $before_widget );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( $title ) :
			echo wp_kses_post( $before_title . $title .$after_title );	
		endif; 	
		?>
	       	<?php 
                require_once FT_PATH. 'addon/TwitterAPIExchange.class.php';
                $settings = array(
                    'oauth_access_token'        => $oauth_access_token,
                    'oauth_access_token_secret' => $oauth_access_token_secret,
                    'consumer_key'              => $consumer_key,
                    'consumer_secret'           => $consumer_secret
                );

                $id            = $screen_name;
                $limit         = $count;
                $url           = "https://api.twitter.com/1.1/statuses/user_timeline.json";
                $requestMethod = "GET";
                $getfield      = "?screen_name=$id&count=$limit";
                $curl_enable   = function_exists('curl_version');

                if ( $curl_enable ) {
                    $twitter = new TwitterAPIExchange( $settings );
                    $string = json_decode( $twitter->setGetfield( $getfield )
                        ->buildOauth( $url, $requestMethod )
                        ->performRequest(), $assoc = TRUE );
                    if ( isset( $string["errors"][0]["message"] ) && $string["errors"][0]["message"] != "" ) {
                        esc_html_e( $string["errors"][0]["message"]. '. Please read document to config it correct.', 'friday-news-toolkit' );
                    } else { ?>
                		<?php if ( ! empty( $string ) ) : ?>
                            <?php foreach ( $string as $items ) : ?>
		                    	<div class="widget-content">
		                            <div class="entry-item">
		                                <div class="entry-content">
		                                   <p><?php echo friday_news_toolkit_convert_links( $items['text'] ) ; ?></p>
		                                </div>
		                                <i class="fa fa-twitter"></i>
		                            </div>
		                        </div>
		                    <?php endforeach; ?>
		                <?php endif; ?>
                    <?php }
                } else { ?>
                	<div class="widget-content">
                        <div class="entry-item">
                            <div class="entry-content">
                               <p><?php esc_html_e( 'Sorry, your server don\'t support curl extension to run this widget', 'friday-news-toolkit' ); ?></p>
                            </div>
                            <i class="fa fa-twitter"></i>
                        </div>
                    </div>
                <?php } ?>
		<?php
        echo wp_kses_post( $after_widget );
		$content = ob_get_clean();
		echo wp_kses_post( $content );
	}
}