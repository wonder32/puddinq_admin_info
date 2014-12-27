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

/**
 *  Add menu option for the page
 *                and      -sub pages
 */

add_action( 'admin_menu', 'puddinq_info_menu' );

/**
 *      menu option for the page
 *                and      -sub pages
 */

function puddinq_info_menu() {
    //view all en options
    add_menu_page(
            'Puddinq admin info', //Pagina titel 
            'Pud Admin', //Menu titel
            'manage_options', //Toegang
            'admin_info', // menu slug
            'puddinq_admin_info_options', //function
            'dashicons-editor-italic', //icon
            '14' //positie;
            );
    //add sub menu nieuw contact
    add_submenu_page(
            'admin_info', //onderdeel van bovenstaand admin info
            'Nieuw contact', 
            'Nieuw contact', 
            'manage_options', //toegang
            'puddinq_admin_info_nieuw', //slug 
            'puddinq_admin_info_nieuw' //functiom
            );

    //add sub menu (verborgen) bewerk contact
    add_submenu_page(
            'null', //geen onderdeel -> daardoor verborgen
            'Bewerk contact', 
            'Bewerk contact', 
            'manage_options', //toegang
            'puddinq_admin_info_bewerk', //slug 
            'puddinq_admin_info_bewerk' //functiom
            );
}

define('PAIDIR', plugin_dir_path(__FILE__));
    require_once(PAIDIR . 'admin/pai-functions.php');
    require_once(PAIDIR . 'admin/pai-page.php');
    require_once(PAIDIR . 'admin/pai-install.php');
    require_once(PAIDIR . 'admin/pai-bewerk.php');
    require_once(PAIDIR . 'admin/pai-maak.php');


/**
 * HOOK
 *  Activation admin/pai-install.php
 * - make table on plugin activation (puddinq_admin_info_install())
 * - fill in first contact on plugin (activation puddinq_admin_info_install_data())
 * Deactivation  admin/pai-install.php
 * - drop table and all information if pugin is uninstalled (puddinq_admin_info_uninstall())
 *      + remove settings from options
 */
// Activation
    register_activation_hook( __FILE__, 'puddinq_admin_info_install' );
    register_activation_hook( __FILE__, 'puddinq_admin_info_install_data' );
// Deactivation
    register_deactivation_hook( __FILE__, 'puddinq_admin_info_uninstall' );
 
    /**
     *  Register script
     */

// Register and enqueue all javascript scripts
function puddinq_admin_info_scripts(){
        wp_register_script('puddinq_admin_info_script',plugin_dir_url( __FILE__ ) . 'js/puddinq-admin-info.js');
        wp_enqueue_script('puddinq_admin_info_script');
}
add_action('wp_enqueue_scripts','puddinq_admin_info_scripts');

// Register and enqueue all stylesheets
function load_puddinq_admin_info_style() {
        wp_register_style( 'puddinq_admin_info_style', plugin_dir_url( __FILE__ ) . 'css/admin-style.css', false, '0.0.1' );
        wp_enqueue_style( 'puddinq_admin_info_style' );
}
add_action( 'admin_enqueue_scripts', 'load_puddinq_admin_info_style' );

/******************
 * Plugin action
 ******************/
    //HOOKS
    add_action('init','puddinq_admin_info_init');
/*****************/
/*  FUNCTIONS
******************/
function puddinq_admin_info_init(){
        //do work
        //puddinq_admin_info_options();


}



