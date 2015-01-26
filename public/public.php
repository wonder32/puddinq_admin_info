<?php /**
 * Puddinq Admin Info Make
 * version 0.2
 * 
 */

//[foobar]

class pai_shortcode {


    /***
     *  add shortcode / register stylesheet/ enqueue stylesheet (if)
     */
    static function init() {
        add_shortcode( 'puddinq_admin_info', array(__CLASS__, 'pai_public' ));
        add_action('init', array(__CLASS__, 'register_pai_stylesheet'));
        add_action( 'wp_head', array(__CLASS__, 'load_pai_stylesheet'));
    }
    
    /***
     *  Shortcode
     */
    
    static function pai_public() {
        pai_logged_in();
        public_puddinq_admin_info_view();
        
    }
    
    /***
     *  Register stylesheet
     */
    
    static function register_pai_stylesheet() {    
        wp_register_style( 'public_puddinq_admin_info_style', dirname(plugin_dir_url( __FILE__ )) . '/css/public-style.css', false, '0.0.1' );

    }
    
    /***
     *  Enqueue stylesheet if pattern shortcode is found in page content
     */
    
    static function load_pai_stylesheet() {
        global $wp_query;
        $posts = $wp_query->posts;
        $pattern = get_shortcode_regex();
        foreach ($posts as $post) {
            if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'puddinq_admin_info', $matches[2] ) ) {
            wp_enqueue_style('public_puddinq_admin_info_style');
            }
        }
    }
}

pai_shortcode::init();


