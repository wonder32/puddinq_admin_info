<?php
/**
 *  Puddinq Admin Info
 *  version 0.2
 * 
 */
/*
Plugin Name: Puddinq scooter
Plugin URI: http://wordpress.org/plugins/puddinq-scooter/
Description: This plugin privides an extra page in the admin area with information
Author: wonder32
Version: 0.2
Author URI: https://puddinq.mobi/
*/

        define('PAIDIR', plugin_dir_path(__FILE__));

class pss_base {

    
    public function __construct() {

        // Actions
        
        add_action( 'admin_menu', array($this, 'pss_menu_page' ));
        add_action( 'admin_menu', array($this, 'pss_menu_sub_page_new' ));
        add_action( 'admin_menu', array($this, 'pss_menu_sub_page_edit' ));
        add_action( 'admin_enqueue_scripts', array($this, 'pss_load_admin_info_style' ));
        add_action( 'admin_enqueue_scripts', array($this, 'pss_load_admin_info_script' ));
        add_action( 'init', array($this, 'pss_load_files')); 
        add_action( 'init', array($this, 'pss_register_installation_hooks'));
        require_once(\PAIDIR . 'public/public.php');
    }
    
    public function pai_load_files() {
        // Load files
        require_once(PAIDIR . 'admin/pss-functions.php');
        require_once(PAIDIR . 'admin/pss-page.php');
        require_once(PAIDIR . 'admin/pss-install.php');
        require_once(PAIDIR . 'admin/pss-bewerk.php');
        require_once(PAIDIR . 'admin/pss-maak.php');
        
        }
        
    public function pai_menu_page() {
            // Add main admin page
            add_menu_page(
            'Puddinq Scooter Shop',       //Pagina titel 
            'PSS Admin',                //Menu titel
            'manage_options',           //Toegang
            'scooter_shop',               // menu slug
            'puddinq_scooter_shop_options', //function
            'dashicons-editor-italic',  //icon
            '14'                        //positie;
            );
    }

    public function pai_menu_sub_page_new() {
            // Add sub page new contact
            add_submenu_page(
            'scooter_shop',               //onderdeel van bovenstaand admin info
            'Nieuw shop', 
            'Nieuw shop', 
            'manage_options',           //toegang
            'puddinq_scooter_shop_nieuw', //slug 
            'puddinq_scooter_shop_nieuw'  //functiom
            );
    }
    
    public function pai_menu_sub_page_edit() {
            // Add hidden sub page edit contact   
        add_submenu_page(
            'null',                     //geen onderdeel -> daardoor verborgen
            'Bewerk shop', 
            'Bewerk shop', 
            'manage_options',           //toegang
            'puddinq_scooter_shop_bewerk',//slug 
            'puddinq_scooter_shop_bewerk' //function
            );
    }
    
    public function pai_register_installation_hooks() {
        // Activation
        register_activation_hook( __FILE__, 'puddinq_scooter_shop_install' );
        register_activation_hook( __FILE__, 'puddinq_shooter_shop_install_data' );
        // Deactivation
        register_deactivation_hook( __FILE__, 'puddinq_scooter_shop_uninstall' );
    }
    
    public function pai_load_admin_info_style() {
        wp_register_style( 'puddinq_scooter_shop_style', plugin_dir_url( __FILE__ ) . 'css/admin-style.css', false, '0.0.1' );
        wp_enqueue_style( 'puddinq_scooter_shop_style' );
    }
    
    public function pai_load_admin_info_script() {
        wp_register_script('puddinq_scooter_shop_script',plugin_dir_url( __FILE__ ) . 'js/puddinq-scooter-info.js');
        wp_enqueue_script('puddinq_scooter_shop_script');
    }
}

$pai_base = new pss_base();
