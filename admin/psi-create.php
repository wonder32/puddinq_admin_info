<?php

/**
 * Puddinq Shop Info - create
 * version 0.3
 * 
 */
class psi_make {
public static function puddinq_shop_info_create () {
    
    // die if not manager
    puddinq_views::psi_cheating();
    
    global $wpdb;    
    $table  = $wpdb->prefix . "psi";
    $time   = current_time( 'mysql' );
    // extract is a dangerous function, do not remove the EXTR_PREFIX_ALL
    // and do not use the variables with the prefix anywhere else !!
    extract($_POST, EXTR_PREFIX_ALL, "psi_unsave");
   
    if (isset($_POST['insert'])) {
        $wpdb->insert(
                $table,
                array(
                      'time' => $time,
                      'name' => $psi_unsave_name,
                      'address' => $psi_unsave_address,
                      'postcode' => $psi_unsave_postcode,
                      'city' => $psi_unsave_city,
                      'telephone' => $psi_unsave_telephone,
                      'url' => $psi_unsave_url,
                      'email' => $psi_unsave_email,
                      'text' => $psi_unsave_text,
                      'moo' => $psi_unsave_moo,
                      'moc' => $psi_unsave_moc,
                      'tuo' => $psi_unsave_tuo,
                      'tuc' => $psi_unsave_tuc,
                      'weo' => $psi_unsave_weo,
                      'wec' => $psi_unsave_wec,
                      'tho' => $psi_unsave_tho,
                      'thc' => $psi_unsave_thc,
                      'fro' => $psi_unsave_fro,
                      'frc' => $psi_unsave_frc,
                      'sao' => $psi_unsave_sao,
                      'sac' => $psi_unsave_sac,
                      'suo' => $psi_unsave_suo,
                      'suc' => $psi_unsave_suc,
                      'type' => $psi_unsave_type),
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
                );
        $id = $wpdb->insert_id;
        $message  = $psi_unsave_name . " " . $psi_unsave_address . " is toegevoegd ";
        $message .= "<a href='" . admin_url('admin.php?page=puddinq_shop_info_edit&id='.$id) . "'>bewerk " . $psi_unsave_name . "</a>";
    }

?>


<?php $wpdb->insert_id; ?>
<div class="wrap psi">
    <h2>Nieuwe Shop</h2>
    
    <?php if (isset($message)): ?>
        <div class="updated"><p><?php echo $message;?></p></div>
    <?php endif;?>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <table class='puddinq_psi'>
        
        <tr>
            <td colspan='2'>Gegevens</td>
            <td colspan='3'>Openingstijden</td>
        </tr>
        <tr>
            <td>Naam:</td><td><input type="text" name="name" placeholder="Naam" required aria-describedby="name-format" pattern="[A-Za-z-0-9\s\,\.]+"/>
                <span id="name-format" class="help">Vb: Scooter Shop</span></td>
            <td>Maandag</td><td><input type="text" name="moo" placeholder="12:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
            <td><input type="text" name="moc" placeholder="18:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
        </tr>
        <tr>
            <td>Adres:</td><td><input type="text" name="address" placeholder="Adres" required pattern="[A-Za-z-0-9\,\.\s]+"/></td>
            <td>Dinsdag</td><td><input type="text" name="tuo" placeholder="12:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
            <td><input type="text" name="tuc" placeholder="18:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
        </tr>
        <tr>
            <td>Postcode:</td><td><input type="text" name="postcode" placeholder="2000 AA" required required aria-describedby="postcode-format" pattern="[0-9]{4}\s[A-Z]{2}"/>
            <input type="text" name="city" placeholder="Amsterdam" required />
                <span id="postcode-format" class="help">Vb: 2000 AA Amsterdam</span></td>
            <td>Woensdag</td><td><input type="text" name="weo" placeholder="12:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
            <td><input type="text" name="wec" placeholder="18:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
        </tr>
        <tr>
            <td>Telefoon:</td><td><input type="text" name="telephone" placeholder="0680000000" required /></td>
            <td>Donderdag</td><td><input type="text" name="tho" placeholder="12:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
            <td><input type="text" name="thc" placeholder="18:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
        </tr>
        <tr>
            <td>Mail:</td><td><input type="email" name="email" placeholder="john@test.nl" required /></td>
            <td>Vrijdag</td><td><input type="text" name="fro" placeholder="12:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
            <td><input type="text" name="frc" placeholder="18:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
        </tr>
        <tr>
            <td>Pagina:</td><td><input type="url" name="url" placeholder="http://www.Weblink.nl" required aria-describedby="url-format" />
                <span id="name-format" class="help">Vb: http://www.perry.nl</span></td>
            <td>Zaterdag</td><td><input type="text" name="sao" placeholder="12:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
            <td><input type="text" name="sac" placeholder="18:00" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
        </tr>
        <tr>
            <td>Winkel soort<td><input type="text" name="type" placeholder="Scooterwinkel" required pattern="[A-Za-z-0-9]+"/></td>
            <td>Zondag</td><td><input type="text" name="suo" placeholder="gesloten" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
            <td><input type="text" name="suc" placeholder="gesloten" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
        </tr>
        <tr>
            <td>Beschrijving:</td><td colspan='4'><textarea name="text" placeholder="Wat is ut"></textarea></td>
        </tr>
        </table>
        <input type='submit' name="insert" value='Save' class='button'>
    </form>
</div>

<?php
}
}
