<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMO | Nouvelle session</title>
    <style media="screen">
      body{
        position: fixed;
        font-size: 2em;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
      }
    </style>
  </head>
  <body>
    <h1>Votre code : <br>
    <?php
    $new_id =  strtoupper(substr(uniqid(), -4));
    file_put_contents('session_id.txt', $new_id);
    file_put_contents("data/simo_".$new_id.".csv", "x,y\n",FILE_APPEND);
    echo $new_id;
    ?>
    </h1>
  </body>
</html>
