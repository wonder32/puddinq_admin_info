<?php
/**
 * Puddinq Admin Info Functions
 * version 0.2
 * 
 */

/**
 * Options admin page
 */

    /**********************************************
     *          PUDDINQ VIEWS
     *          - ADMIN PAGE:  puddinq_shop_info_view_all
     *          - PUBLIC PAGE: public_puddinq_shop_info_view
     *          - 2 security functions
     *              - ONLY LOGGED IN: psi_logged_in
     *              - ONLY MANAGERS:  psi_cheating
     **********************************************/
class puddinq_views {    

    public static function public_puddinq_shop_info_view() {
                // make database connection available for function
                global $wpdb;
                // get all rows from database
                $query = " SELECT * FROM wp_psi";
                // check if it worked
                if($wpdb->query($query) === FALSE) {
                    $wpdb->show_errors();
                    $wpdb->print_error(); 
                } else {
                    $results = $wpdb->get_results($query);
                }
                // loop true the results
                foreach ( $results as $shop ) {
                    echo "<table class='puddinq_psi wp-list-table widefat fixed'>\n";
                    echo "\t\t\t\t<tr><td colspan='2'>$shop->name</td><td colspan='3'>Openingstijden</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Naam:</td><td>" . $shop->name . "</td><td>Maandag</td><td>" . $shop->moo . "</td><td>" . $shop->moc . "</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Adres:</td><td>" . $shop->address . "</td><td>Dinsdag</td><td>" . $shop->tuo . "</td><td>" . $shop->tuc . "</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Postcode:</td><td>" . $shop->postcode . "</td><td>Woensdag</td><td>" . $shop->weo . "</td><td>" . $shop->wec . "</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Telefoon:</td><td>" . $shop->telephone . "</td><td>Donderdag</td><td>" . $shop->tho . "</td><td>" . $shop->thc . "</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Mail:</td><td>" . $shop->email . "</td><td>Vrijdag</td><td>" . $shop->fro . "</td><td>" . $shop->frc . "</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Pagina:</td><td><a href='" . $shop->url . "'>" . $shop->url . "</a></td><td>Zaterdag</td><td>" . $shop->sao . "</td><td>" . $shop->sac . "</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Beschrijving</td><td>" . $shop->text . "</td>\n\t\t\t\t<td>Zondag</td><td>" . $shop->suo . "</td><td>" . $shop->suc . "</td></tr>\n";
                    echo "\t\t\t\t<tr><td>Laatste wijziging</td><td colspan='4'>" . $shop->time . "</td></tr>\n";
                    echo "\t\t\t\t</table>";
                    echo "\t\t\t\t<br />\n";
                    echo "\t\t\t\t<hr />\n";
                    echo "\t\t\t\t<br />\n";
                }
  
    }
    
    public static function puddinq_shop_info_view_all() {
                // make database connection available for function
                global $wpdb;
                // get all rows from database
                $query = " SELECT * FROM wp_psi";
                // check if it worked
                if($wpdb->query($query) === FALSE) {
                    $wpdb->show_errors();
                    $wpdb->print_error(); 
                } else {
                    $results = $wpdb->get_results($query);
                }
                // loop true the results
                 foreach ( $results as $shop ) {
                    echo "<table class='puddinq_psi'>";
                    echo "<tr><td colspan='1'>$shop->name</td><td colspan='2'>Openingstijden</td>";
                    echo "<td><a href='" . admin_url('admin.php?page=puddinq_shop_info_edit&id='.$shop->id) . "'>Update</a></td>";
                    echo "<td><form action='" . admin_url('admin.php?page=puddinq_shop_info_edit&id='.$shop->id) . "' method='post' >";
                    ?>
                    <input class='button' type='submit' value='verwijder' name='delete'
                    onclick="return confirm('&iquest;Weet je zeker dat je <?php echo $shop->name; ?> wilt verwijderen ?')">
                    <?php
                    echo "</form></td></tr>";
                    echo "<tr><td>Naam:</td><td>" . $shop->name . "</td><td>Maandag</td><td>" . $shop->moo . "</td><td>" . $shop->moc . "</td></tr>";
                    echo "<tr><td>Adres:</td><td>" . $shop->address . "</td><td>Dinsdag</td><td>" . $shop->tuo . "</td><td>" . $shop->tuc . "</td></tr>";
                    echo "<tr><td>Postcode:</td><td>" . $shop->postcode . "</td><td>Woensdag</td><td>" . $shop->weo . "</td><td>" . $shop->wec . "</td></tr>";
                    echo "<tr><td>Telefoon:</td><td>" . $shop->telephone . "</td><td>Donderdag</td><td>" . $shop->tho . "</td><td>" . $shop->thc . "</td></tr>";
                    echo "<tr><td>Mail:</td><td>" . $shop->email . "</td><td>Vrijdag</td><td>" . $shop->fro . "</td><td>" . $shop->frc . "</td></tr>";
                    echo "<tr><td>Pagina:</td><td><a href='" . $shop->url . "'>" . $shop->url . "</a></td><td>Zaterdag</td><td>" . $shop->sao . "</td><td>" . $shop->sac . "</td></tr>";
                    echo "<tr><td>Beschrijving</td><td>" . $shop->text . "</td><td>Zondag</td><td>" . $shop->suo . "</td><td>" . $shop->suc . "</td></tr>";
                    echo "\t\t\t\t<tr><td>Laatste wijziging</td><td colspan='4'>" . $shop->time . "</td></tr>\n";
                    echo "</table>";
                    echo "<br />";
                    echo "<hr />";
                    echo "<br />";
                    echo '</table>';
                 }
    
    }

    public static function psi_cheating() {

                    // die if not manager
                if ( !current_user_can( 'manage_options' ) )  {
                        wp_die( __( 'Cheatin&#8217; uh?' ) );
                }

    }

    public static function psi_logged_in() {
                if ( !is_user_logged_in() ) {
                    wp_die('je moet ingelogd zijn om deze gegevens te bekijken');
                }
    }
// end of class
}