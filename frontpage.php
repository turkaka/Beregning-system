

<?php


function pluginindexfunctions (){
    
  if($_POST["action"]=="update"){
    if(!isset($_POST["testplugin"]) || ! wp_verify_nonce($_POST["testplugin"], 'testplugin')){
      echo "Error";
    }else {
      global $wpdb;
      $postnr = sanitize_text_field($_POST["postnr"]);
      $windows = sanitize_text_field($_POST["windows"]);
      $hustype = sanitize_text_field($_POST["hustype"]);
      $type = sanitize_text_field($_POST["type"]);
      $hustype = sanitize_text_field($_POST["hustype"]);
      $ofte = sanitize_text_field($_POST["ofte"]);

      $wpdb->insert("{$wpdb->prefix}tableberegn",array("postnr"=>$postnr,"windows"=>$windows,"doors"=>$doors,"antal"=>$antal,"type"=>$type,"hustype"=>$hustype,"ofte"=>$ofte));
      echo '<div class="updated">Setting updated</div>';
    }

  }
?>
<div class="beregn">
    
<h1>Beregning System </h1>


<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  <label for="wname">Hvad er din postnummer?</label>
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



  $adminpost = array(5000,5200,5210,5220,5230,5240,5250,5260,5270,5280,5290,5320,5330,5340);



if(isset($_POST['postnr'])) { // har vi sendt form
  $postnr = $_POST["postnr"];
  $windows = $_POST["windows"];
  $hustype = $_POST["hustype"];


      if(in_array($postnr, $adminpost)) { // info er korrekt

         session_start();

         $_SESSION['postnr'] = $postnr;
          if ($windows == 9 && $hustype == 1) {
            $a = $beregnlist->windows9;
            $b= $beregnlist->villa1;
            echo $a + $b;
        ?>    <br>  <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php

        }elseif ($windows == 9 && $hustype == 2 ) {
          $a = $beregnlist->windows9;
          $b= $beregnlist->villa2;
          echo $a + $b;
                  ?>    <br>  <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }elseif ($windows == 9 && $hustype == 3 ) {
          $a = $beregnlist->windows9;
          $b= $beregnlist->villa3;
          echo $a + $b;
                  ?>   <br>   <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }elseif ($windows == 19 && $hustype == 1 ) {
          $a = $beregnlist->windows19;
          $b= $beregnlist->villa1;
          echo $a + $b;
                  ?>    <br>  <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }elseif ($windows == 19 && $hustype == 2 ) {
          $a = $beregnlist->windows19;
          $b= $beregnlist->villa2;
          echo $a + $b;
                  ?>   <br>   <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }elseif ($windows == 19 && $hustype == 3 ) {
          $a = $beregnlist->windows19;
          $b= $beregnlist->villa3;
          echo $a + $b;
                  ?>    <br>  <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }elseif ($windows == 29 && $hustype == 1 ) {
          $a = $beregnlist->windows29;
          $b= $beregnlist->villa1;
          echo $a + $b;
                  ?>  <br>    <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }elseif ($windows == 29 && $hustype == 2 ) {
          $a = $beregnlist->windows29;
          $b= $beregnlist->villa2;
          echo $a + $b;
                  ?>     <br> <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }elseif ($windows == 29 && $hustype == 3 ) {
          $a = $beregnlist->windows29;
          $b= $beregnlist->villa3;
          echo $a + $b;
                  ?>   <br> <button onclick="myFunction()">Få tilbud</button> <button onclick="myFunction1()">Bestil Rengøring</button><?php


        }
             else{
        echo 'Prisen er 5000kr';
        }

      } else {
         echo 'Vi udlever ikke vinduespolering til udenfor Odense';
         
      }
}
 else {
   echo 'Tilføj et beregning';
}
}
           ?> 
<style>
    #tilbudDIV {
  width: 50%;
  padding: 50px 0;
  text-align: center;
  background-color: lightblue;
  margin-top: 20px;
  display: none ;
}
    #bestilDIV {
  width: 50%;
  padding: 50px 0;
  text-align: center;
  background-color: lightblue;
  margin-top: 20px;
  display: none ;
}

</style>
<div id="tilbudDIV">
  

<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  
  <label for="wname">Dit Navn</label>
   <input type="text" name="email" value="" placeholder="Dit navn">


  <label for="wname">Din email</label>
  <input type="text" name="email" value="" placeholder="Din Email">

  
  <input type="submit" value="send">

</form>
<br>
</div>
<div id="bestilDIV">
  

<form action="" method="post">
  <?php wp_nonce_field('testplugin','testplugin'); ?>
  
  <label for="wname">Dit Navn</label>
   <input type="text" name="navn" value="" placeholder="Dit navn">


  <label for="wname">Din email</label>
  <input type="text" name="email" value="" placeholder="Din Email">

  
  <label for="wname">Din adress</label>
  <input type="text" name="adress" value="" placeholder="Din Adress">
 
  <label for="wname">Din telefon nummer</label>
  <input type="text" name="telefon" value="" placeholder="Din Telefon nummer">

  <input type="checkbox" id="person1" name="person1" value="Persondata"> Ja, jeg accepterer at du kan kontakt med mig

  <input type="submit" value="send">

</form>
<br>
</div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("tilbudDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  
}
function myFunction1() {
  var x = document.getElementById("bestilDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  
}
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


