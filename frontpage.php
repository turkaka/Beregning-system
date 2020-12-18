<?php


function pluginindexfunctions (){


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="beregn">

<h1>Beregningssystem </h1>


<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  <label for="wname">Hvad er dit postnummer?</label>
  <input type="text" name="postnr" value="" placeholder="Postnummer">

  <label for="wname">Hvor mange vinduer har du?</label>
   <select id="window" name="windows">
    <option value="9">1-9</option>
    <option value="19">10-19</option>
    <option value="29">20-29</option>
  </select><br><br>
  <label for="bname">Boligtype</label>
  <select id="hustype" name="hustype">
    <option value="1">Et plan</option>
    <option value="2">To plan</option>
    <option value="3">Tre plan</option>
  </select><br><br>

  <input type="submit" value="send">

</form>
<br>


<?php

global $wpdb;
$list = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tableberegn ORDER BY id DESC LIMIT 1");

foreach ($list as $beregnlist){

    $postnummer =  $beregnlist->postnr;

    $allowed_postal_codes = explode(',', $postnummer);



if(isset($_POST['postnr'])) { // har vi sendt form

  $postnr = $_POST["postnr"];
  $windows = $_POST["windows"];
  $hustype = $_POST["hustype"];
  $tilbud=' <br> <br> <button id="hide">Få tilbud</button> <button id="hide1">Bestil Rengøring</button>';


      if(in_array($postnr, $allowed_postal_codes)) { // info er korrekt

         session_start();

         $_SESSION['postnr'] = $postnr;
          if ($windows == 9 && $hustype == 1) {
            $a = $beregnlist->windows9;
            $b= $beregnlist->villa1;
            echo $a + $b.' kr.';
            echo $tilbud;


        }elseif ($windows == 9 && $hustype == 2 ) {
          $a = $beregnlist->windows9;
          $b= $beregnlist->villa2;
          echo $a + $b.' kr.';
        echo $tilbud;

        }elseif ($windows == 9 && $hustype == 3 ) {
          $a = $beregnlist->windows9;
          $b= $beregnlist->villa3;
          echo $a + $b.' kr.';
          echo $tilbud;

        }elseif ($windows == 19 && $hustype == 1 ) {
          $a = $beregnlist->windows19;
          $b= $beregnlist->villa1;
          echo $a + $b.' kr.';
          echo $tilbud;

        }elseif ($windows == 19 && $hustype == 2 ) {
          $a = $beregnlist->windows19;
          $b= $beregnlist->villa2;
          echo $a + $b.' kr.';
          echo $tilbud;

        }elseif ($windows == 19 && $hustype == 3 ) {
          $a = $beregnlist->windows19;
          $b= $beregnlist->villa3;
          echo $a + $b.' kr.';
          echo $tilbud;

        }elseif ($windows == 29 && $hustype == 1 ) {
          $a = $beregnlist->windows29;
          $b= $beregnlist->villa1;
          echo $a + $b.' kr.';
         echo $tilbud;

        }elseif ($windows == 29 && $hustype == 2 ) {
          $a = $beregnlist->windows29;
          $b= $beregnlist->villa2;
          echo $a + $b.' kr.';
         echo $tilbud;


        }elseif ($windows == 29 && $hustype == 3 ) {
          $a = $beregnlist->windows29;
          $b= $beregnlist->villa3;
          echo $a + $b.' kr.';
         echo $tilbud;

        }
             else{
        echo 'Prisen er 5000kr';
        }

      } else {
         echo 'Vi kan desværre ikke levere vinduespolering uden for Odense';

      }
}
 else {
   echo 'Tilføj et beregning';
}
}
           ?>
<div class="formul">

<div id="tilbudDIV">


<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  <label for="wname">Få tilbud</label>

   <input type="text" name="email" value="" placeholder="Dit navn">

  <input type="text" name="email" value="" placeholder="Din Email">


  <input type="submit" value="send">

</form>
<br>
</div>
<div id="bestilDIV">


<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  <label for="wname">Bestil Rengøring</label>

   <input type="text" name="navn" value="" placeholder="Dit navn">

  <input type="text" name="email" value="" placeholder="Din Email">

    <input type="text" name="adress" value="" placeholder="Din Adress">

  <input type="text" name="telefon" value="" placeholder="Din Telefon nummer">

  <p><input type="checkbox" id="person1" name="person1" value="Persondata"> Ja, jeg accepterer at du kan kontakt med mig</p>

  <input type="submit" value="send">

</form>
<br>
</div>
</div>

</div>

<script>

$(document).ready(function(){
  $("#hide").click(function(){
    $("#tilbudDIV").toggle();
  });
});
$(document).ready(function(){
  $("#hide1").click(function(){
    $("#bestilDIV").toggle();
  });
});

</script>

<?php


}

// Register a new shortcode: [cr_custom_registration]
add_shortcode( 'beregn', 'custom_registration_shortcode' );

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    pluginindexfunctions();
    return ob_get_clean();
}


?>
