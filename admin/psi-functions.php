<?php
/**
 * Puddinq Admin Info Functions
 * version 0.2
 * 
 */

/**
 * Options admin page
 */


    

    function public_puddinq_scooter_shop_view() {
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
        echo "<table class='psi wp-list-table widefat fixed'>";
        echo '<tr><th>Voornaam</th><th>Achternaam</th><th>Tekst</th><th>URL</th></tr>';
        foreach ( $results as $contact ) {
            echo '<tr>';
            echo '<td>' . $contact->fname . '</td>';
            echo '<td>' . $contact->lname . '</td>';
            echo '<td>' . $contact->text . '</td>';
            echo "<td><a href='" . $contact->url . "'>weblink</a></td></tr>";
        }
        echo '</table>';    
    }
    
    function puddinq_scooter_shop_view_all() {
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
        echo "<table class='wp-list-table widefat fixed'>";
        echo '<tr><th>Voornaam</th><th>Achternaam</th><th>Tekst</th><th>URL</th><th>Bewerk</th><th>Verwijder</th></tr>';
        foreach ( $results as $contact ) {
            echo '<tr>';
            echo '<td>' . $contact->fname . '</td>';
            echo '<td>' . $contact->lname . '</td>';
            echo '<td>' . $contact->text . '</td>';
            echo "<td><a href='" . $contact->url . "'>weblink</a></td>";
            echo "<td><a href='" . admin_url('admin.php?page=puddinq_scooter_shop_bewerk&id='.$contact->id) . "'>Update</a></td>";
            echo "<td><form action='" . admin_url('admin.php?page=puddinq_scooter_shop_bewerk&id='.$contact->id) . "' method='post' >";
            ?>
            <input class='button' type='submit' value='verwijder' name='delete'
            onclick="return confirm('&iquest;Weet je zeker dat je <?php echo $contact->lname; ?> wilt verwijderen ?')">
            <?php
            echo "</form></td>";
            echo '</tr>';
        }
        echo '</table>';    
    }

    function psi_cheating() {

            // die if not manager
        if ( !current_user_can( 'manage_options' ) )  {
                wp_die( __( 'Cheatin&#8217; uh?' ) );
        }

    }

    function psi_logged_in() {
        if ( !is_user_logged_in() ) {
            wp_die('je moet ingelogd zijn om deze gegevens te bekijken');
        }
    }
