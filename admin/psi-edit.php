<?php
/**
 *  Puddinq Admin Info update field
 *  version 0.2
 * 
 */
class psi_edit {
public static function puddinq_shop_info_edit () {
    
    // die if not manager
    psi_cheating();

    global $wpdb;
    
    $table  = $wpdb->prefix . "psi";
    $id     = $_GET["id"];
    //(isset($_POST["time"]))? $time = $_POST["time"]: $time = current_time( 'mysql' );
    (isset($_POST["fname"]))? $fname = $_POST["fname"]: $fname = '';
    (isset($_POST["lname"]))? $lname = $_POST["lname"]: $lname = '';
    (isset($_POST["psi_text"]))? $psi_text = $_POST["psi_text"]: $psi_text = '';
    (isset($_POST["psi_url"]))? $psi_url = $_POST["psi_url"]: $psi_url = '';
//update
if(isset($_POST['update'])){
        $time = current_time( 'mysql' );
        
        $wpdb->update( 
	$table, 
	array( 
		'time' => $time,	// string
		'fname' => $fname,	// string
		'lname' => $lname,	// string
		'text' => $psi_text,	// string
		'url' => $psi_url	// string
	), 
	array( 'id' => $id ), 
	array( 
		'%s',	// value1
		'%s',	// value2
		'%s',	// value2
		'%s',	// value2
		'%s'	// value2
	), 
	array( '%s' ) 
        );
        
}

//delete
else if(isset($_POST['delete'])){	
	$wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id = %s",$id));
}
else{//selecting value to update
    
	$contacts = $wpdb->get_results($wpdb->prepare("SELECT * from $table WHERE id=%d", $id));
	foreach ($contacts as $s ){
                $time   = $s->time;
		$fname  = $s->fname;
                $lname   = $s->lname;
                $psi_text= $s->text;
                $psi_url = $s->url;
	}
}
?>
<link type="text/css" href="<?php echo PSIDIR; ?>/css/admin-style.css" rel="stylesheet" />

<div class="wrap psi">
    <h2>Contact:</h2>

    <?php if(isset($_POST['delete'])){?>
        <div class="updated"><p>Contact verwijderd</p></div>
        <a class="button" href="<?php echo admin_url('admin.php?page=scooter_shop')?>">&laquo; Terug naar contacten</a>

    <?php } else if(isset($_POST['update'])) {?>
        <div class="updated"><p>Contact bewerkt</p></div>
        <a href="<?php echo admin_url('admin.php?page=scooter_shop')?>">&laquo; Back to schools list</a>

    <?php } else {?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p>Geen http://</p>
            <table class='wp-list-table widefat fixed'>
            <tr><th>Laatste wijziging</th><td><input type="text" name="time" value="<?php echo $time;?>" required/></td></tr>
            <tr><th>Voornaam</th><td><input type="text" name="fname" value="<?php echo $fname;?>" required/></td></tr>
            <tr><th>Achternaam</th><td><input type="text" name="lname" value="<?php echo $lname;?>" required/></td></tr>
            <tr><th>Beschrijving</th><td><textarea name="psi_text"><?php echo $psi_text;?></textarea></td></tr>
            <tr><th>Email</th><td><input type="email" name="psi_email" placeholder="john@test.nl" required /></td></tr>
            <tr><th>Link</th><td><input type="url" name="psi_url" value="<?php echo $psi_url;?>" required pattern="https?://.+"/></td></tr>
            </table>
            <input type='submit' name="update" value='Opslaan' class='button'> &nbsp;&nbsp;
            <input type='submit' name="delete" value='Verwijder' class='button' 
                   onclick="return confirm('&iquest;Weet je zeker dat je hem wilt verwijderen ?')">

        </form>
<?php }?>

</div>
<?php
}
}