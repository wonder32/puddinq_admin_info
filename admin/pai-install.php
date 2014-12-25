<?php
/**
 * @package Puddinq Admin Info Install
 * @version 0.1
 */

/**
 * Setup install function
 */
    /*
     * TABLE
     */
    // die if not manager

function puddinq_admin_info_install(){
        pai_cheating();
        global $wpdb;
        global $pai_db_version; 
        
        $pai_db_version = '0.1';
        $table_name = $wpdb->prefix . "pai";

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          fname tinytext NOT NULL,
          lname tinytext NOT NULL,
          text text NOT NULL,
          url varchar(55) DEFAULT '' NOT NULL,
          UNIQUE KEY id (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        add_option( 'pai_db_version', $pai_db_version );
}
          
    /*
     * FILL TABLE
     */

function puddinq_admin_info_install_data(){
        $pai_fname = 'Stefan';
        $pai_lname = 'Schotvanger';
        $pai_text = 'Owner';
        $pai_url = 'www.puddinq.mobi/wip/profiel/';

        global $wpdb;
        $table_name = $wpdb->prefix . "pai";

        $wpdb->insert( 
                $table_name, 
                array( 
                        'time' => current_time( 'mysql' ), 
                        'fname' => $pai_fname,
                        'lname' => $pai_lname,
                        'text' => $pai_text,
                        'url'  => $pai_url,
                ) 
        );

}

/******************
 * Plugin options / settings
 ******************/

        function register_puddinq_admin_info_settings() {
	//register our settings
        register_setting( 'puddinq-info', 'option1' );
	register_setting( 'puddinq-info', 'option2' );
	register_setting( 'puddinq-info', 'option3' );
        }

    //register the settings
    add_action( 'admin_init', 'register_puddinq_admin_info_settings' );

/*******************************
 *          UNINSTALL
 *******************************/

function puddinq_admin_info_uninstall() {

    global $wpdb;
    $table = $wpdb->prefix."pai";

    //Delete any options thats stored
    delete_option('pai_db_version');
    delete_option('option1');
    delete_option('option2');
    delete_option('option3');

    $wpdb->query("DROP TABLE IF EXISTS $table");
}

