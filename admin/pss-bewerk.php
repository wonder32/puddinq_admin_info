<?php
/**
 *  Puddinq Admin Info update field
 *  version 0.2
 * 
 */

function puddinq_scooter_shop_bewerk () {
    
    // die if not manager
    pss_cheating();

    global $wpdb;
    
    $table  = $wpdb->prefix . "pss";
    $id     = $_GET["id"];
    //(isset($_POST["time"]))? $time = $_POST["time"]: $time = current_time( 'mysql' );
    (isset($_POST["fname"]))? $fname = $_POST["fname"]: $fname = '';
    (isset($_POST["lname"]))? $lname = $_POST["lname"]: $lname = '';
    (isset($_POST["pss_text"]))? $pss_text = $_POST["pss_text"]: $pss_text = '';
    (isset($_POST["pss_url"]))? $pss_url = $_POST["pss_url"]: $pss_url = '';
//update
if(isset($_POST['update'])){
        $time = current_time( 'mysql' );
        
        $wpdb->update( 
	$table, 
	array( 
		'time' => $time,	// string
		'fname' => $fname,	// string
		'lname' => $lname,	// string
		'text' => $pss_text,	// string
		'url' => $pss_url	// string
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
                $pss_text= $s->text;
                $pss_url = $s->url;
	}
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/puddinq-admin-info/admin-style.css" rel="stylesheet" />

<div class="wrap pss">
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
            <tr><th>Beschrijving</th><td><textarea name="pss_text"><?php echo $pss_text;?></textarea></td></tr>
            <tr><th>Email</th><td><input type="email" name="pss_email" placeholder="john@test.nl" required /></td></tr>
            <tr><th>Link</th><td><input type="url" name="pss_url" value="<?php echo $pss_url;?>" required pattern="https?://.+"/></td></tr>
            </table>
            <input type='submit' name="update" value='Opslaan' class='button'> &nbsp;&nbsp;
            <input type='submit' name="delete" value='Verwijder' class='button' 
                   onclick="return confirm('&iquest;Weet je zeker dat je hem wilt verwijderen ?')">

        </form>
<?php }?>

</div>
<?php
}