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

    add_action('wp_enqueue_scripts',"addCss");
    add_action('admin_enqueue_scripts',"addCss");


function addCss() {
   wp_enqueue_style('prefix-style',plugins_url('css/style.css',__FILE__));
}


include('frontpage.php');


if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}tableberegn'") != $wpdb->prefix . 'tableberegn') {
      $wpdb->query("CREATE TABLE {$wpdb->prefix}tableberegn(
        id integer not null auto_increment,
        postnr TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        windows9 TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        windows19 TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        windows29 TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        villa1 TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        villa2 TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        villa3 TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
        PRIMARY KEY (id)
        );");
    $wpdb->insert("{$wpdb->prefix}tableberegn",array("postnr"=>"Postnummer","windows9"=>"intaste priser","windows19"=>"intaste priser","windows29"=>"intaste priser","villa1"=>"intaste priser","villa2"=>"intaste priser","villa3"=>"intaste priser"));

}

add_action("admin_menu","PluginAdminMenu");

function PluginAdminMenu(){

  add_menu_page("Beregning System", "Beregning System", "manage_options","beregning-settings","pluginadminfunctions","dashicons-grid-view", NULL);

}



function pluginadminfunctions (){
  if($_POST["action"]=="update"){
    if(!isset($_POST["testplugin"]) || ! wp_verify_nonce($_POST["testplugin"], 'testplugin')){
      echo "Error";
    }else {
      global $wpdb;
      $postnr = sanitize_text_field($_POST["postnr"]);
      $windows9 = sanitize_text_field($_POST["windows9"]);
      $windows19 = sanitize_text_field($_POST["windows19"]);
      $windows29 = sanitize_text_field($_POST["windows29"]);
      $villa1 = sanitize_text_field($_POST["villa1"]);
      $villa2 = sanitize_text_field($_POST["villa2"]);
      $villa3 = sanitize_text_field($_POST["villa3"]);


        $wpdb->update("{$wpdb->prefix}tableberegn", array("postnr"=>$postnr,"windows9"=>$windows9,"windows19"=>$windows19,"windows29"=>$windows29,"villa1"=>$villa1,"villa2"=>$villa2,"villa3"=>$villa3), array('id' => '1'));

      echo '<div class="updated">Setting updated</div>';
    }

  }
?>
<div class="beregn">
<h1>Beregningssystem </h1>
<p>Admin Panel</p>
<?php
global $wpdb;
$list = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tableberegn ORDER BY id DESC LIMIT 1");
foreach ($list as $beregnlist){

?>


<form action="" method="post">

  <?php wp_nonce_field('testplugin','testplugin'); ?>

  <label for="wname">Hvilket postnummer vil du gerne arbejde i?</label>
    <label for="info">Indtast postnummer eksempel (5000, 4200, 7450)</label>

  <textarea name="postnr" >
  <?php echo $beregnlist->postnr;  ?>

        </textarea>

  <label for="wname">Vinduernes priser</label>
    <p>1-9 Vinduer : <input type="text" name="windows9" value="<?php echo $beregnlist->windows9;  ?>"></p>

    <p>10-19 Vinduer: <input type="text" name="windows19" value="<?php echo $beregnlist->windows19;  ?>"></p>

    <p>20-29 Vinduer: <input type="text" name="windows29" value="<?php echo $beregnlist->windows29;  ?>"></p>

<br>
  <label for="bname">Boligtype </label>
  <p>Eksta betaling for forskellige plan.</p>

  <p>Et plan: <input type="text" name="villa1" value="<?php echo $beregnlist->villa1;  ?>"></p>

  <p>To plan: <input type="text" name="villa2" value="<?php echo $beregnlist->villa2;  ?>"></p>

  <p>Tre plan: <input type="text" name="villa3" value="<?php echo $beregnlist->villa3;  ?>"></p>

  <input type="hidden" name="action" value="update" placeholder="">

  <input type="submit" value="send">

</form>
<br>
</div>
<?php
}
}


?>
