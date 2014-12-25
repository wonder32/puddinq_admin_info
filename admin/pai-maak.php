<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function puddinq_admin_info_nieuw () {
    
    // die if not manager
    pai_cheating();
    
    global $wpdb;    
    $table  = $wpdb->prefix . "pai";
    $time   = current_time( 'mysql' );
    $fname   = $_POST['fname'];
    $lname   = $_POST['lname'];
    $pai_text= $_POST['pai_text'];
    $pai_url = $_POST['pai_url'];
    
    if (isset($_POST['insert'])) {
        $wpdb->insert(
                'wp_pai',
                array(
                    'time' => $time,
                    'fname' => $fname,
                    'lname' => $lname,
                    'text' => $pai_text,
                    'url' => $pai_url),
                array('%s', '%s', '%s', '%s', '%s')
                );
        $message .= "toegevoegd";

    }

?>

<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/puddinq-admin-info/admin-style.css" rel="stylesheet" />
<?php         $wpdb->insert_id; ?>
<div class="wrap">
    <h2>Nieuw contact</h2>
    
    <?php if (isset($message)): ?>
        <div class="updated"><p><?php echo $message;?></p></div>
    <?php endif;?>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <p>Three capital letters for the ID</p>
        <table class='wp-list-table widefat fixed'>
        <tr><th>Voornaam</th><td><input type="text" name="fname" value="<?php echo $fname;?>"/></td></tr>
        <tr><th>Achternaam</th><td><input type="text" name="lname" value="<?php echo $lname;?>"/></td></tr>
        <tr><th>Beschrijving</th><td><input type="text" name="pai_text" value="<?php echo $pai_text;?>"/></td></tr>
        <tr><th>Link</th><td><input type="text" name="pai_url" value="<?php echo $pai_url;?>"/></td></tr>
        </table>
        <input type='submit' name="insert" value='Save' class='button'>
    </form>
</div>

<?php
}