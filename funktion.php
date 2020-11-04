
<?php


add_filter("the_content","beregning_system_Function");
function beregning_system_Function($content){
  $skriv = "Everything will be fine!";
  return $content.$skriv;
}
