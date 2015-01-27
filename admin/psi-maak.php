<?php

/**
 * Puddinq Admin Info Make
 * version 0.2
 * 
 */
class psi_make {
public static function puddinq_scooter_shop_nieuw () {
    
    // die if not manager
    psi_cheating();
    
    global $wpdb;    
    $table  = $wpdb->prefix . "psi";
    $time   = current_time( 'mysql' );
    (isset($_POST["fname"]))? $fname = $_POST["fname"]: $fname = '';
    (isset($_POST["lname"]))? $lname = $_POST["lname"]: $lname = '';
    (isset($_POST["psi_text"]))? $psi_text = $_POST["psi_text"]: $psi_text = '';
    (isset($_POST["psi_url"]))? $psi_url = $_POST["psi_url"]: $psi_url = '';
    
    if (isset($_POST['insert'])) {
        $wpdb->insert(
                $table,
                array(
                    'time' => $time,
                    'fname' => $fname,
                    'lname' => $lname,
                    'text' => $psi_text,
                    'url' => $psi_url),
                array('%s', '%s', '%s', '%s', '%s')
                );
        $id = $wpdb->insert_id;
        $message  = $fname . " " . $lname . " is toegevoegd ";
        $message .= "<a href='" . admin_url('admin.php?page=puddinq_scooter_shop_bewerk&id='.$id) . "'>bewerk " . $fname . "</a>";
    }

?>


<?php $wpdb->insert_id; ?>
<div class="wrap psi">
    <h2>Nieuw contact</h2>
    
    <?php if (isset($message)): ?>
        <div class="updated"><p><?php echo $message;?></p></div>
    <?php endif;?>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <p>Geen http://</p>
        <table class='wp-list-table widefat fixed'>
        <tr><th>Voornaam</th><td><input type="text" name="fname" placeholder="Voornaam" required /></td></tr>
        <tr><th>Achternaam</th><td><input type="text" name="lname" placeholder="Achternaam" required /></td></tr>
        <tr><th>Beschrijving</th><td><textarea name="psi_text" placeholder="Wie is ut"></textarea></td></tr>
        <tr><th>Email</th><td><input type="email" name="psi_email" placeholder="john@test.nl" required /></td></tr>
        <tr><th>Link</th><td><input type="url" name="psi_url" placeholder="www.Weblink.nl" required pattern="https?://.+"/></td></tr>
        </table>
        <input type='submit' name="insert" value='Save' class='button'>
    </form>
</div>

<?php
}
}