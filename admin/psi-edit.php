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

        //(isset($_POST["time"]))? $time = $_POST["time"]: $time = current_time( 'mysql' );
        (isset($_POST["name"]))? $psi_name = $_POST["name"]: $psi_name = '';
        (isset($_POST["address"]))? $psi_address = $_POST["address"]: $psi_address = '';
        (isset($_POST["postcode"]))? $psi_postcode = $_POST["postcode"]: $psi_postcode = '';
        (isset($_POST["city"]))? $psi_city = $_POST["city"]: $psi_city = '';
        (isset($_POST["telephone"]))? $psi_telephone = $_POST["telephone"]: $psi_telephone = '';
        (isset($_POST["url"]))? $psi_url = $_POST["url"]: $psi_url = '';
        (isset($_POST["email"]))? $psi_email = $_POST["email"]: $psi_email = '';
        (isset($_POST["text"]))? $psi_text = $_POST["text"]: $psi_text = '';
        (isset($_POST["moo"]))? $psi_moo = $_POST["moo"]: $psi_moo = '';
        (isset($_POST["moc"]))? $psi_moc = $_POST["moc"]: $psi_moc = '';
        (isset($_POST["tuo"]))? $psi_tuo = $_POST["tuo"]: $psi_tuo = '';
        (isset($_POST["tuc"]))? $psi_tuc = $_POST["tuc"]: $psi_tuc = '';
        (isset($_POST["weo"]))? $psi_weo = $_POST["weo"]: $psi_weo = '';
        (isset($_POST["wec"]))? $psi_wec = $_POST["wec"]: $psi_wec = '';
        (isset($_POST["tho"]))? $psi_tho = $_POST["tho"]: $psi_tho = '';
        (isset($_POST["thc"]))? $psi_thc = $_POST["thc"]: $psi_thc = '';
        (isset($_POST["fro"]))? $psi_fro = $_POST["fro"]: $psi_fro = '';
        (isset($_POST["frc"]))? $psi_frc = $_POST["frc"]: $psi_frc = '';
        (isset($_POST["sao"]))? $psi_sao = $_POST["sao"]: $psi_sao = '';
        (isset($_POST["sac"]))? $psi_sac = $_POST["sac"]: $psi_sac = '';
        (isset($_POST["suo"]))? $psi_suo = $_POST["suo"]: $psi_suo = '';
        (isset($_POST["suc"]))? $psi_suc = $_POST["suc"]: $psi_suc = '';
    //update

        $time = current_time( 'mysql' );    
        $wpdb->update( 
	$table, 
	array( 
              'time' => $time,
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
              'suo' => $psi_suo,
              'suc' => $psi_suc
	), 
	array( 'id' => $id ), 
	array( 
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
	), 
	array( '%s' ) 
        );
        
        $message  = $psi_name . " " . $psi_address . " is bewerkt<br />";
        $message .= "<a href='" . admin_url('admin.php?page=puddinq_shop_info_edit&id='.$id) . "'>bewerk " . $psi_name . " opnieuw</a><br />";
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
                        <td>Naam:</td><td><input type="text" name="name" placeholder="Naam" value="<?php echo $s->name; ?>" required aria-describedby="name-format" pattern="[A-Za-z-0-9\s]+"/>
                            <span id="name-format" class="help">Vb: Scooter Shop</span></td>
                        <td>Maandag</td><td><input type="text" name="moo" placeholder="12:00" value="<?php echo $s->moo; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="moc" placeholder="18:00" value="<?php echo $s->moc; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Adres:</td><td><input type="text" name="address" placeholder="Adres" value="<?php echo $s->address; ?>" required pattern="[A-Za-z-0-9\s]+"/></td>
                        <td>Dinsdag</td><td><input type="text" name="tuo" placeholder="12:00" value="<?php echo $s->tuo; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="tuc" placeholder="18:00" value="<?php echo $s->tuc; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Postcode:</td><td><input type="text" name="postcode" placeholder="2000 AA" value="<?php echo $s->postcode; ?>" required required aria-describedby="postcode-format" pattern="[0-9]{4}\s[A-Z]{2}"/>
                            <span id="name-format" class="help">Vb: 2000 AA</span></td>
                        <td>Woensdag</td><td><input type="text" name="weo" placeholder="12:00" value="<?php echo $s->weo; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="wec" placeholder="18:00" value="<?php echo $s->wec; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Telefoon:</td><td><input type="text" name="telephone" placeholder="0680000000" value="<?php echo $s->telephone; ?>" required /></td>
                        <td>Donderdag</td><td><input type="text" name="tho" placeholder="12:00" value="<?php echo $s->tho; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="thc" placeholder="18:00" value="<?php echo $s->thc; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Mail:</td><td><input type="email" name="email" placeholder="john@test.nl" value="<?php echo $s->email; ?>" required /></td>
                        <td>Vrijdag</td><td><input type="text" name="fro" placeholder="12:00" value="<?php echo $s->fro; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="frc" placeholder="18:00" value="<?php echo $s->frc; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Pagina:</td><td><input type="url" name="url" placeholder="http://www.Weblink.nl" value="<?php echo $s->url; ?>" required aria-describedby="url-format" />
                            <span id="name-format" class="help">Vb: http://www.perry.nl</span></td>
                        <td>Zaterdag</td><td><input type="text" name="sao" placeholder="12:00" value="<?php echo $s->sao; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="sac" placeholder="18:00" value="<?php echo $s->sac; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    <tr>
                        <td>Beschrijving:</td><td><textarea name="psi_text" placeholder="Wat is ut"><?php echo $s->text; ?></textarea></td>
                        <td>Zondag</td><td><input type="text" name="suo" placeholder="gesloten" value="<?php echo $s->suo; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                        <td><input type="text" name="suc" placeholder="gesloten" value="<?php echo $s->suc; ?>" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}|gesloten"/></td>
                    </tr>
                    </table>
                    <input type='submit' name="updated" value='Opslaan' class='button'>
                </form>
             <?php 
        }
    }
}
}