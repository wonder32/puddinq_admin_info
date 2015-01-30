<?php
/**
 *  Puddinq Shop Info - update
 *  version 0.3
 * 
 */
class psi_edit {
public static function puddinq_shop_info_edit () {
    
    // die if not manager
    puddinq_views::psi_cheating();
    
    echo "<div class='wrap psi'>";
    echo "<h2>Shop:</h2>";

    if (!isset($_GET["id"])) {
        wp_die('je moet een geldig id geven');
    }
    
    global $wpdb;
    $id = $_GET["id"];
    $table  = $wpdb->prefix . "psi";
    
    if(isset($_POST['delete'])){	
	$wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id = %s",$id));
        echo "<div class='updated'><p>Shop verwijderd</p></div>";
        echo "<a class='button' href=" . admin_url('admin.php?page=shop_info') . ">&laquo; Terug naar overzicht</a>";
    }
    
    if(isset($_POST['updated'])){

 
    extract($_POST, EXTR_PREFIX_ALL, "psi_unsave");
    //update

        $time = current_time( 'mysql' );    
        $wpdb->update( 
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
              'suc' => $psi_unsave_suc
	), 
	array( 'id' => $id ), 
	array( 
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
	), 
	array( '%s' ) 
        );
        
        $message  = $psi_unsave_name . " " . $psi_unsave_address . " is bewerkt<br />";
        $message .= "<a href='" . admin_url('admin.php?page=puddinq_shop_info_edit&id='.$id) . "'>bewerk " . $psi_unsave_name . " opnieuw</a><br />";
        $message .= "<a href=" . admin_url('admin.php?page=shop_info') . ">&laquo; Terug naar overzicht</a>";
        echo $message;

        
    } else {

	$result = $wpdb->get_results($wpdb->prepare("SELECT * from $table WHERE id=%d", $id));
	foreach ($result as $s ){
            ?>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <table class='puddinq_psi'>

                    <tr>
                        <td colspan='2'>Gegevens</td>
                        <td colspan='3'>Openingstijden</td>
                    </tr>
                    <tr>
                        <td>Naam:</td><td><input type="text" name="name" placeholder="Naam" value="<?php echo $s->name; ?>" required aria-describedby="name-format" pattern="[A-Za-z-0-9\s\.\,]+"/>
                            <span id="name-format" class="help">Vb: Scooter Shop</span></td>
                        <td>Maandag</td><td><input type="text" name="moo" placeholder="12:00" value="<?php echo $s->moo; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="moc" placeholder="18:00" value="<?php echo $s->moc; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Adres:</td><td><input type="text" name="address" placeholder="Adres" value="<?php echo $s->address; ?>" required pattern="[A-Za-z-0-9\s\,\.]+"/></td>
                        <td>Dinsdag</td><td><input type="text" name="tuo" placeholder="12:00" value="<?php echo $s->tuo; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="tuc" placeholder="18:00" value="<?php echo $s->tuc; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Postcode:</td><td><input type="text" name="postcode" placeholder="2000 AA" value="<?php echo $s->postcode; ?>" required required aria-describedby="postcode-format" pattern="[0-9]{4}\s[A-Z]{2}"/>
            <input type="text" name="city" placeholder="Amsterdam" value="<?php echo $s->city; ?>" required />
                            <span id="name-format" class="help">Vb: 2000 AA Amsterdam</span></td>
                        <td>Woensdag</td><td><input type="text" name="weo" placeholder="12:00" value="<?php echo $s->weo; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="wec" placeholder="18:00" value="<?php echo $s->wec; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Telefoon:</td><td><input type="text" name="telephone" placeholder="0680000000" value="<?php echo $s->telephone; ?>" required /></td>
                        <td>Donderdag</td><td><input type="text" name="tho" placeholder="12:00" value="<?php echo $s->tho; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="thc" placeholder="18:00" value="<?php echo $s->thc; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Mail:</td><td><input type="email" name="email" placeholder="john@test.nl" value="<?php echo $s->email; ?>" required /></td>
                        <td>Vrijdag</td><td><input type="text" name="fro" placeholder="12:00" value="<?php echo $s->fro; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="frc" placeholder="18:00" value="<?php echo $s->frc; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Pagina:</td><td><input type="url" name="url" placeholder="http://www.Weblink.nl" value="<?php echo $s->url; ?>" required aria-describedby="url-format" />
                            <span id="name-format" class="help">Vb: http://www.perry.nl</span></td>
                        <td>Zaterdag</td><td><input type="text" name="sao" placeholder="12:00" value="<?php echo $s->sao; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="sac" placeholder="18:00" value="<?php echo $s->sac; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Beschrijving:</td><td><textarea name="text" placeholder="Wat is ut"><?php echo $s->text; ?></textarea></td>
                        <td>Zondag</td><td><input type="text" name="suo" placeholder="gesloten" value="<?php echo $s->suo; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="suc" placeholder="gesloten" value="<?php echo $s->suc; ?>" required pattern="([0-1]{0,1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    </table>
                    <input type='submit' name="updated" value='Opslaan' class='button'>
                </form>
             <?php 
        }
    }
}
}