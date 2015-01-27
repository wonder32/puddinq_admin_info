<?php
/**
 *  Puddinq Scooter Shop
 *  version 0.2
 * 
 */
/*
Plugin Name: Puddinq Shop Info
Plugin URI: http://wordpress.org/plugins/puddinq-shop-info/
Description: This plugin provides an extra page in the admin area with the ability to manage shop info for multiple shops
Author: wonder32
Version: 0.2
Author URI: https://puddinq.mobi/
*/
    /**********************************************
     *          LOAD FILES
     **********************************************/
        define('PSIDIR', plugin_dir_path(__FILE__));
        require_once(PSIDIR . 'admin/psi-functions.php');
        require_once(PSIDIR . 'admin/psi-page.php');
        require_once(PSIDIR . 'admin/psi-install.php');
        require_once(PSIDIR . 'admin/psi-bewerk.php');
        require_once(PSIDIR . 'admin/psi-maak.php');
        require_once(PSIDIR . 'public/public.php');
        

class psi_base {
    
    public function __construct() {

            // Actions
            add_action('init', array($this, 'init'));

    }
    
    public function init(){
            add_action( 'admin_menu', array($this, 'psi_menu_page' ));
            add_action( 'admin_menu', array($this, 'psi_menu_sub_page_new' ));
            add_action( 'admin_menu', array($this, 'psi_menu_sub_page_edit' ));
            add_action( 'admin_enqueue_scripts', array($this, 'psi_load_shop_info_style' ));
            add_action( 'admin_enqueue_scripts', array($this, 'psi_load_shop_info_script' ));
            //register the settings
            add_action( 'admin_init', array('puddinq_shop_install', 'register_puddinq_shop_info_settings' ));
}
        
    public function psi_menu_page() {
            // Add main admin page
            add_menu_page(
            'Puddinq Shop Info',       //Pagina titel 
            'PSI Admin',                //Menu titel
            'manage_options',           //Toegang
            'shop_info',               // menu slug
            array('psi_page', 'puddinq_scooter_shop_options'), //function
            'dashicons-editor-italic',  //icon
            '14'                        //positie;
            );
    }

    public function psi_menu_sub_page_new() {
            // Add sub page new contact
            add_submenu_page(
            'shop_info',               //onderdeel van bovenstaand admin info
            'Nieuw shop', 
            'Nieuw shop', 
            'manage_options',           //toegang
            'puddinq_shop_info_nieuw', //slug 
            array('psi_make', 'puddinq_scooter_shop_nieuw')  //functiom
            );
    }
    
    public function psi_menu_sub_page_edit() {
            // Add hidden sub page edit contact   
        add_submenu_page(
            'null',                     //geen onderdeel -> daardoor verborgen
            'Bewerk shop', 
            'Bewerk shop', 
            'manage_options',           //toegang
            'puddinq_shop_info_bewerk',//slug 
            array('psi_edit', 'puddinq_scooter_shop_bewerk') //function
            );
    }

    
    public function psi_load_shop_info_style() {
        wp_register_style( 'puddinq_shop_info_style', plugin_dir_url( __FILE__ ) . 'css/admin-style.css', false, '0.0.1' );
        wp_enqueue_style( 'puddinq_shop_info_style' );
    }
    
    public function psi_load_shop_info_script() {
        wp_register_script('puddinq_shop_info_script',plugin_dir_url( __FILE__ ) . 'js/puddinq-scooter-info.js');
        wp_enqueue_script('puddinq_shop_info_script');
    }
}

if( class_exists( 'psi_base' ) ) {
        $psi_base = new psi_base;
        // Activation
        register_activation_hook(__FILE__, array('puddinq_shop_install', 'puddinq_shop_info_install' ));
        register_activation_hook(__FILE__, array('puddinq_shop_install', 'puddinq_shop_info_install_data' ));
        // Deactivation
        register_deactivation_hook(__FILE__, array('puddinq_shop_install', 'puddinq_shop_info_uninstall' ));
  
}