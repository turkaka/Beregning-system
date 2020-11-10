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

global $wpdb;

if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}tableberegn'") != $wpdb->prefix . 'tableberegn') {
      $wpdb->query("CREATE TABLE {$wpdb->prefix}tableberegn(
        id integer not null auto_increment,
        postnr TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        windows TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        doors TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        antal TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        type TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        hustype TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        ofte TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        PRIMARY KEY (id)
        );");
}

add_action('admin_enqueue_scripts',"addCss");

function addCss() {
   wp_enqueue_style('prefix-style',plugins_url('css/style.css',__FILE__));
}

add_action("admin_menu","PluginAdminMenu");

function PluginAdminMenu(){

  add_menu_page("Beregning System", "Beregning System", "manage_options","beregning-settings","pluginadminfunctions","dashicons-grid-view", NULL);
  add_submenu_page("beregning-settings","Vinduespolering","Vinduespolering","manage_options","vinduespolering");

}

function menumuz() {
add_menu_page("Wordpress Sistem Destek Eklentisi","SİSDESTEK","manage_options","ana_menu",array("destek","anasayfa"),"dashicons-shield",99);

}

function pluginadminfunctions (){
  if($_POST["action"]=="update"){
    if(!isset($_POST["testplugin"]) || ! wp_verify_nonce($_POST["testplugin"], 'testplugin')){
      echo "Error";
    }else {
      global $wpdb;
      $postnr = sanitize_text_field($_POST["postnr"]);
      $windows = sanitize_text_field($_POST["windows"]);
      $doors = sanitize_text_field($_POST["doors"]);
      $type = sanitize_text_field($_POST["type"]);
      $hustype = sanitize_text_field($_POST["hustype"]);
      $ofte = sanitize_text_field($_POST["ofte"]);

      $wpdb->insert("{$wpdb->prefix}tableberegn",array("postnr"=>$postnr,"windows"=>$windows,"doors"=>$doors,"antal"=>$antal,"type"=>$type,"hustype"=>$hustype,"ofte"=>$ofte));
      echo '<div class="updated">Setting updated</div>';
    }

  }
?>
<h1>Beregning System </h1>
<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>

  <label for="">Beregn system</label><br>
  <input type="text" name="postnr" value="" placeholder="Postnummer">
  <input type="text" name="windows" value="" placeholder="Antal Vinduer">
  <input type="text" name="doors" value="" placeholder="Antal Dør">

  <input type="text" name="ofte" value="" placeholder="Hvor mange gang">
  <input type="hidden" name="action" value="update" placeholder="">
  <input type="submit" value="send">

</form>
<br>
<h1>Beregning Tabel fra Database</h1>
<?php
global $wpdb;
$list = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tableberegn");
foreach ($list as $beregnlist){
  echo "Postnummer: ".$beregnlist->postnr." Antal vinduer: ".$beregnlist->windows." Antal dør: ".$beregnlist->doors." Area: ".$beregnlist->antal." Vinduer Type: ".$beregnlist->type." Hustype: ".$beregnlist->hustype." Hvor mange gang: ".$beregnlist->ofte;
  echo '<br>';
}
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode( 'kasim', 'custom_registration_shortcode' );

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    pluginadminfunctions();
    return ob_get_clean();
}


?>
