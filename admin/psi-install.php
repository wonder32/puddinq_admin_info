<?php
/**
 * @package Puddinq Admin Info Install
 * @version 0.1
 */

    /**********************************************
     *          INSTALL CLASS
     *          - CREATE TABLE
     *              - REGISTER psi_db_version
     *          - FILL TABLE
     *          - REGISTER WORDPRESS OPTIONS
     *          - UNINSTALL
     *              - DROP TABLE
     *              - UNREGISTER WORDPRESS OPTIONS
     *              - UNREGISTER psi_db_version
     **********************************************/

class puddinq_shop_install {

     /**********************************************
     *          CREATE TABLE
     **********************************************/
    

    public static function puddinq_shop_info_install(){
        puddinq_views::psi_cheating();
            global $wpdb;
            global $psi_db_version; 

            $pai_db_version = '0.1';
            $table_name = $wpdb->prefix . "psi";

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
              id mediumint(9) NOT NULL AUTO_INCREMENT,
              time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
              name tinytext NOT NULL,
              address tinytext NOT NULL,
              postcode tinytext NOT NULL,
              telephone tinytext NOT NULL,
              url varchar(55) DEFAULT '' NOT NULL,
              email varchar(55) DEFAULT '' NOT NULL,
              text tinytext DEFAULT '' NOT NULL,
              city varchar(55) DEFAULT '' NOT NULL,
              moo varchar(9) DEFAULT '' NOT NULL,
              moc varchar(9) DEFAULT '' NOT NULL,
              tuo varchar(9) DEFAULT '' NOT NULL,
              tuc varchar(9) DEFAULT '' NOT NULL,
              weo varchar(9) DEFAULT '' NOT NULL,
              wec varchar(9) DEFAULT '' NOT NULL,
              tho varchar(9) DEFAULT '' NOT NULL,
              thc varchar(9) DEFAULT '' NOT NULL,
              fro varchar(9) DEFAULT '' NOT NULL,
              frc varchar(9) DEFAULT '' NOT NULL,
              sao varchar(9) DEFAULT '' NOT NULL,
              sac varchar(9) DEFAULT '' NOT NULL,
              suo varchar(9) DEFAULT '' NOT NULL,
              suc varchar(9) DEFAULT '' NOT NULL,
              UNIQUE KEY id (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_option( 'pai_db_version', $pai_db_version );
    }
    /**********************************************
     *          FILL TABLE
     **********************************************/

        public static function puddinq_shop_info_install_data(){
              $psi_name = 'Jacobs Scooters';
              $psi_address = 'Bingerweg 16';
              $psi_postcode = '2031 AZ';
              $psi_city = 'Haarlem';
              $psi_telephone = '064209661';
              $psi_url = 'http://www.jacobsscooters.com';
              $psi_email = 'jacobsscooters@hotmail.com';
              $psi_text = 'Jocobs Scooters is een scootersloop in de Waarderpolder. Zij verrichten echter ook reperaties, onderhoud en verkopen scooters en verkopen zowel nieuwe als gebruikte onderdelen. Het belangrijkste pluspunt is dat zij op maandag open zijn';
              $psi_moo = '12:00';
              $psi_moc = '18:00';
              $psi_tuo = '10:00';
              $psi_tuc = '18:00';
              $psi_weo = '10:00';
              $psi_wec = '21:00';
              $psi_tho = '10:00';
              $psi_thc = '18:00';
              $psi_fro = '10:00';
              $psi_frc = '18:00';
              $psi_sao = '10:00';
              $psi_sac = '17:00';
              $psi_soo = 'gesloten';
              $psi_suc = 'gesloten';

                global $wpdb;
                $table_name = $wpdb->prefix . "psi";

                $wpdb->insert( 
                        $table_name, 
                        array( 
                              'time' => current_time( 'mysql' ), 
                              'name' => $psi_name,
                              'address' => $psi_address,
                              'postcode' => $psi_postcode,
                              'city' => $psi_city,
                              'telephone' => $psi_telephone,
                              'url' => $psi_url,
                              'email' => $psi_email,
                              'text' => $psi_text,
                              'moo' => $psi_moo,
                              'moc' => $psi_moc,
                              'tuo' => $psi_tuo,
                              'tuc' => $psi_tuc,
                              'weo' => $psi_weo,
                              'wec' => $psi_wec,
                              'tho' => $psi_tho,
                              'thc' => $psi_thc,
                              'fro' => $psi_fro,
                              'frc' => $psi_frc,
                              'sao' => $psi_sao,
                              'sac' => $psi_sac,
                              'suo' => $psi_soo,
                              'suc' => $psi_suc,
                        ) 
                );

        }

    /**********************************************
     *          PLUGIN SETTINGS IN WORDPRESS TABLE (unused)
     **********************************************/

        public static function register_puddinq_shop_info_settings() {
                //register our settings
                register_setting( 'puddinq-info', 'option1' );
                register_setting( 'puddinq-info', 'option2' );
                register_setting( 'puddinq-info', 'option3' );
        }



    /**********************************************
     *          UNINSTALL
     **********************************************/

        public static function puddinq_shop_info_uninstall() {

            global $wpdb;
            $table = $wpdb->prefix."psi";

            //Delete any options thats stored
            delete_option('psi_db_version');
            delete_option('option1');
            delete_option('option2');
            delete_option('option3');

            $wpdb->query("DROP TABLE IF EXISTS $table");
        }
}