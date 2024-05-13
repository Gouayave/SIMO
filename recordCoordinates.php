<?php
  $session_id = file_get_contents('session_id.txt');
  $pos_x = $_GET['x'];
  $pos_y = $_GET['y'];

  $fichier = "data/simo_".$session_id.".csv";

  if (file_exists($fichier)) {
      echo $session_id.",".$pos_x.",".$pos_y;
    	file_put_contents($fichier, $pos_x.",".$pos_y."\n", FILE_APPEND);
  }else {
    echo "Le fichier de donnée n'existe pas.";
  }

?>
