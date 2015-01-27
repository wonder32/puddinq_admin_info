<?php

/**
 * Puddinq Admin Info Make
 * version 0.2
 * 
 */

function puddinq_scooter_shop_nieuw () {
    
    // die if not manager
    pss_cheating();
    
    global $wpdb;    
    $table  = $wpdb->prefix . "pss";
    $time   = current_time( 'mysql' );
    (isset($_POST["fname"]))? $fname = $_POST["fname"]: $fname = '';
    (isset($_POST["lname"]))? $lname = $_POST["lname"]: $lname = '';
    (isset($_POST["pss_text"]))? $pss_text = $_POST["pss_text"]: $pss_text = '';
    (isset($_POST["pss_url"]))? $pss_url = $_POST["pss_url"]: $pss_url = '';
    
    if (isset($_POST['insert'])) {
        $wpdb->insert(
                $table,
                array(
                    'time' => $time,
                    'fname' => $fname,
                    'lname' => $lname,
                    'text' => $pss_text,
                    'url' => $pss_url),
                array('%s', '%s', '%s', '%s', '%s')
                );
        $id = $wpdb->insert_id;
        $message  = $fname . " " . $lname . " is toegevoegd ";
        $message .= "<a href='" . admin_url('admin.php?page=puddinq_scooter_shop_bewerk&id='.$id) . "'>bewerk " . $fname . "</a>";
    }

?>


<?php $wpdb->insert_id; ?>
<div class="wrap pss">
    <h2>Nieuw contact</h2>
    
    <?php if (isset($message)): ?>
        <div class="updated"><p><?php echo $message;?></p></div>
    <?php endif;?>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <p>Geen http://</p>
        <table class='wp-list-table widefat fixed'>
        <tr><th>Voornaam</th><td><input type="text" name="fname" placeholder="Voornaam" required /></td></tr>
        <tr><th>Achternaam</th><td><input type="text" name="lname" placeholder="Achternaam" required /></td></tr>
        <tr><th>Beschrijving</th><td><textarea name="pss_text" placeholder="Wie is ut"></textarea></td></tr>
        <tr><th>Email</th><td><input type="email" name="pss_email" placeholder="john@test.nl" required /></td></tr>
        <tr><th>Link</th><td><input type="url" name="pss_url" placeholder="www.Weblink.nl" required pattern="https?://.+"/></td></tr>
        </table>
        <input type='submit' name="insert" value='Save' class='button'>
    </form>
</div>

<?php
}