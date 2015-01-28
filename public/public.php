<?php /**
 * Puddinq Shop Info Public
 * version 0.3
 * 
 */


class psi_shortcode {


    /***
     *  add shortcode / register stylesheet/ enqueue stylesheet (if)
     */
    static function init() {
        add_shortcode( 'puddinq_shop_info', array(__CLASS__, 'psi_public' ));
        add_action('init', array(__CLASS__, 'register_psi_stylesheet'));
        add_action( 'wp_head', array(__CLASS__, 'load_psi_stylesheet'));
    }
    
    /***
     *  Shortcode
     */
    
    static function psi_public() {
        //puddinq_views::psi_logged_in();
        puddinq_views::public_puddinq_shop_info_view();
        
    }
    
    /***
     *  Register stylesheet
     */
    
    static function register_psi_stylesheet() {    
        wp_register_style( 'public_puddinq_shop_info_style', dirname(plugin_dir_url( __FILE__ )) . '/css/public-style.css', false, '0.0.1' );

    }
    
    /***
     *  Enqueue stylesheet if pattern shortcode is found in page content
     */
    
    static function load_psi_stylesheet() {
        global $wp_query;
        $posts = $wp_query->posts;
        $pattern = get_shortcode_regex();
        foreach ($posts as $post) {
            if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'puddinq_shop_info', $matches[2] ) ) {
            wp_enqueue_style('public_puddinq_shop_info_style');
            }
        }
    }
}

psi_shortcode::init();


