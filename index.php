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
  add_submenu_page("beregning-settings","Vinduespolering","Vinduespolering","manage_options","vinduespolering",array("beregning-settings","vinduespolering"));

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

<form action="/action_page.php">

  <input type="submit" value="Submit">
</form>
<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  <label for="wname">Hvad er din postnummer?</label>
  <input type="text" name="postnr" value="" placeholder="Postnummer">

  <label for="wname">Hvor mange vinduer har du?</label>
    <br>
   <select id="window" name="windows">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
  </select>

  <label for="wname">Hvad er din vinduestype type`?</label>
  <select id="windowtype" name="windowtype">
   <option value="etfagsvindue">etfagsvindue</option>
   <option value="tofagsvindue">tofagsvindue</option>
   <option value="trefagsvindue">trefagsvindue</option>
   <option value="firefagsvindue">firefagsvindue</option>
   <option value="femfagsvindue">femfagsvindue</option>
   <option value="seksfagsvindue">seksfagsvindue</option>
 </select>

    <br>

  <label for="dname">Hvor mange glasdøre har du?</label><br>
   <select id="gdoor" name="gdoors">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
  </select>

    <br>

  <label for="bname">Boligtype</label><br>
  <select id="hustype" name="hustype">
    <option value="villa1">Villa - et plan</option>
    <option value="villa2">Villa - to plan</option>
    <option value="lejlighed">Lejlighed</option>
    <option value="Rækkehus">Rækkehus</option>
  </select>
    <br>
    <label for="bname">Boigareal</label><br>
  <input type="text" name="antal" value="" placeholder="Bolig Areal">
  <br>
  <label for="bname">Boligtype</label><br>
  <select id="hustype" name="hustype">
    <option value="villa1">Villa - et plan</option>
    <option value="villa2">Villa - to plan</option>
    <option value="lejlighed">Lejlighed</option>
    <option value="Rækkehus">Rækkehus</option>
  </select>  <br>

    <label for="bname">Hvad tit ville du gerne rengøring</label><br>
    <select id="ofte" name="ofte">
      <option value="engang">En gang om måneden</option>
      <option value="togang">To gang om måneden</option>
      <option value="hveruge">Hver uge</option>
    </select>  <br>

  <input type="submit" value="send">

</form>
<br>
<h1>Beregning Tabel fra Database</h1>
<?php

}

?>
<h1>Beregning Tabel fra Database</h1>
<?php
function pluginfunctions (){
global $wpdb;
$list = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tableberegn");
foreach ($list as $beregnlist){
  echo "Postnummer: ".$beregnlist->postnr." Antal vinduer: ".$beregnlist->windows." Antal dør: ".$beregnlist->doors." Area: ".$beregnlist->antal." Vinduer Type: ".$beregnlist->type." Hustype: ".$beregnlist->hustype." Hvor mange gang: ".$beregnlist->ofte;
  echo '<br>';
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
