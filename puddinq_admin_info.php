<?php
/**
 *  Puddinq Admin Info
 *  version 0.2
 * 
 */
/*
Plugin Name: Puddinq Admin Info
Plugin URI: http://wordpress.org/plugins/puddinq-admin/
Description: This plugin privides an extra page in the admin area with information
Author: wonder32
Version: 0.2
Author URI: https://puddinq.mobi/
*/

        define('PAIDIR', plugin_dir_path(__FILE__));

class pai_base {

    
    public function __construct() {

        // Actions
        
        add_action( 'admin_menu', array($this, 'pai_menu_page' ));
        add_action( 'admin_menu', array($this, 'pai_menu_sub_page_new' ));
        add_action( 'admin_menu', array($this, 'pai_menu_sub_page_edit' ));
        add_action( 'admin_enqueue_scripts', array($this, 'pai_load_admin_info_style' ));
        add_action( 'admin_enqueue_scripts', array($this, 'pai_load_admin_info_script' ));
        add_action( 'init', array($this, 'pai_load_files')); 
        add_action( 'init', array($this, 'pai_register_installation_hooks'));
        require_once(\PAIDIR . 'public/public.php');
    }
    
    public function pai_load_files() {
        // Load files
        require_once(PAIDIR . 'admin/pai-functions.php');
        require_once(PAIDIR . 'admin/pai-page.php');
        require_once(PAIDIR . 'admin/pai-install.php');
        require_once(PAIDIR . 'admin/pai-bewerk.php');
        require_once(PAIDIR . 'admin/pai-maak.php');
        
        }
        
    public function pai_menu_page() {
            // Add main admin page
            add_menu_page(
            'Puddinq admin info',       //Pagina titel 
            'Pud Admin',                //Menu titel
            'manage_options',           //Toegang
            'admin_info',               // menu slug
            'puddinq_admin_info_options', //function
            'dashicons-editor-italic',  //icon
            '14'                        //positie;
            );
    }

    public function pai_menu_sub_page_new() {
            // Add sub page new contact
            add_submenu_page(
            'admin_info',               //onderdeel van bovenstaand admin info
            'Nieuw contact', 
            'Nieuw contact', 
            'manage_options',           //toegang
            'puddinq_admin_info_nieuw', //slug 
            'puddinq_admin_info_nieuw'  //functiom
            );
    }
    
    public function pai_menu_sub_page_edit() {
            // Add hidden sub page edit contact   
        add_submenu_page(
            'null',                     //geen onderdeel -> daardoor verborgen
            'Bewerk contact', 
            'Bewerk contact', 
            'manage_options',           //toegang
            'puddinq_admin_info_bewerk',//slug 
            'puddinq_admin_info_bewerk' //functiom
            );
    }
    
    public function pai_register_installation_hooks() {
        // Activation
        register_activation_hook( __FILE__, 'puddinq_admin_info_install' );
        register_activation_hook( __FILE__, 'puddinq_admin_info_install_data' );
        // Deactivation
        register_deactivation_hook( __FILE__, 'puddinq_admin_info_uninstall' );
    }
    
    public function pai_load_admin_info_style() {
        wp_register_style( 'puddinq_admin_info_style', plugin_dir_url( __FILE__ ) . 'css/admin-style.css', false, '0.0.1' );
        wp_enqueue_style( 'puddinq_admin_info_style' );
    }
    
    public function pai_load_admin_info_script() {
        wp_register_script('puddinq_admin_info_script',plugin_dir_url( __FILE__ ) . 'js/puddinq-admin-info.js');
        wp_enqueue_script('puddinq_admin_info_script');
    }
}

$pai_base = new pai_base();
