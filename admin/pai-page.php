<?php
/**
 *  Puddinq Admin Info Page
 *  version 0.1
 * 
 */

function puddinq_admin_info_options () {

    // die if not welcome
    if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'Cheatin&#8217; uh?' ) );
    }

    // global settings form
?>

<link type="text/css" href="<?php echo PAIDIR; ?>css/style.css" rel="stylesheet" />
<div class="wrap">
<h2>
<?php
$page_title = 'Puddinq admin info';
printf( __( 'Welcome to WordPress&nbsp;%s' ), $page_title );
?></h2>

 <form method="post" action="options.php">
  <?php settings_fields( 'puddinq-info' ); ?>
  <?php //do_settings( 'puddinq-info' ); ?>
    <table class="form-table">
     <tr valign="top">
      <th scope="row">option 1</th>
      <td><input type="text" name="option1" value="<?php echo get_option('option1'); ?>" /></td>
     </tr>

    <tr valign="top">
      <th scope="row">option 2</th>
      <td><input type="text" name="option2" value="<?php echo get_option('option2'); ?>" /></td>
    </tr>

    <tr valign="top">
      <th scope="row">option 3</th>
      <td><input type="text" name="option3" value="<?php echo get_option('option3'); ?>" /></td>
    </tr>
   </table>
    <?php submit_button(); ?>
 </form>
    
    <br />
    <br />


<?php
    // 
?>
    <?php puddinq_admin_info_view_all()?>
</div>
<?php
}
?>