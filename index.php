<?php
/*
Plugin Name: Rengøring beregning system
Plugin URI: www.kasim.dk/beregn
Description: Beregning system til Rengøring firmaer.
Version: 4.0
Author: Kasim Kara, Benjamin Fabricius Porsgaard, Mark Jørgensen
Author URI: www.kasim.dk/beregn
License: GNU
*/


add_action("admin_menu","PluginAdminMenu");

function PluginAdminMenu(){

  add_menu_page("Beregning System", "Beregning System Sætting", "manage_options","beregning-settings","pluginadminfunctions");

}

function pluginadminfunctions (){
  if($_POST["action"]=="update"){
    if(!isset($_POST["testplugin"]) || ! wp_verify_nonce($_POST["testplugin"], 'testplugin')){
      echo "Error";
    }else {
      $navn = sanitize_text_field($_POST["navn"]);
      update_option('navn', $navn);
      echo '<div class="updated">Sætting updated</div>';
    }

  }
?>
<h1>Beregning System </h1>
<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  <?php echo get_option('navn');?>

  <label for=""></label>
  <input type="text" name="navn" value="">
  <input type="hidden" name="action" value="update">
  <input type="submit" value="send">

</form>

<?php

}

?>
