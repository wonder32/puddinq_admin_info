<?php
/**
 * @package Puddinq Admin Info Install
 * @version 0.1
 */

/**
 * Setup install function
 */
    /**********************************************
     *          CREATE TABLE
     **********************************************/
    // die if not manager
class puddinq_scooter_install {
    

    public static function puddinq_scooter_shop_install(){
        //pai_cheating();
            global $wpdb;
            global $pss_db_version; 

            $pai_db_version = '0.1';
            $table_name = $wpdb->prefix . "pss";

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
    /**********************************************
     *          FILL TABLE
     **********************************************/

        public static function puddinq_shooter_shop_install_data(){
                $pss_fname = 'Stefan';
                $pss_lname = 'Schotvanger';
                $pss_text = 'Owner';
                $pss_url = 'www.puddinq.mobi/wip/profiel/';

                global $wpdb;
                $table_name = $wpdb->prefix . "pss";

                $wpdb->insert( 
                        $table_name, 
                        array( 
                                'time' => current_time( 'mysql' ), 
                                'fname' => $pss_fname,
                                'lname' => $pss_lname,
                                'text' => $pss_text,
                                'url'  => $pss_url,
                        ) 
                );

        }

    /**********************************************
     *          PLUGIN SETTINGS IN WORDPRESS TABLE (unused)
     **********************************************/

        public static function register_puddinq_scooter_shop_settings() {
                //register our settings
                register_setting( 'puddinq-info', 'option1' );
                register_setting( 'puddinq-info', 'option2' );
                register_setting( 'puddinq-info', 'option3' );
        }



    /**********************************************
     *          UNINSTALL
     **********************************************/

        public static function puddinq_scooter_shop_uninstall() {

            global $wpdb;
            $table = $wpdb->prefix."pss";

            //Delete any options thats stored
            delete_option('pss_db_version');
            delete_option('option1');
            delete_option('option2');
            delete_option('option3');

            $wpdb->query("DROP TABLE IF EXISTS $table");
        }
}