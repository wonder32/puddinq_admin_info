<?php /**
 * Puddinq Admin Info Make
 * version 0.2
 * 
 */

//[foobar]

<<<<<<< HEAD
class pai_shortcode {
=======
class pss_shortcode {
>>>>>>> scooter


    /***
     *  add shortcode / register stylesheet/ enqueue stylesheet (if)
     */
    static function init() {
        add_shortcode( 'puddinq_scooter_shop', array(__CLASS__, 'pss_public' ));
        add_action('init', array(__CLASS__, 'register_pss_stylesheet'));
        add_action( 'wp_head', array(__CLASS__, 'load_pss_stylesheet'));
    }
    
    /***
     *  Shortcode
     */
    
    static function pss_public() {
        pss_logged_in();
        public_puddinq_scooter_shop_view();
        
    }
    
    /***
     *  Register stylesheet
     */
    
    static function register_pss_stylesheet() {    
        wp_register_style( 'public_puddinq_scooter_shop_style', dirname(plugin_dir_url( __FILE__ )) . '/css/public-style.css', false, '0.0.1' );

    }
    
    /***
     *  Enqueue stylesheet if pattern shortcode is found in page content
     */
    
    static function load_pss_stylesheet() {
        global $wp_query;
        $posts = $wp_query->posts;
        $pattern = get_shortcode_regex();
        foreach ($posts as $post) {
            if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'puddinq_scooter_shop', $matches[2] ) ) {
            wp_enqueue_style('public_puddinq_scooter_shop_style');
            }
        }
    }
}

pss_shortcode::init();


