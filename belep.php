<?php
    session_start();

    $eredmeny = "";

    if (isset($_GET['kilepes'])){
        session_unset();
        $eredmeny = "Sikeres kilpés";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="upload.css">
    <title>Belepes</title>
    <?php
    //adatbázis
      include 'db.inc.php';
      
      
      $db = new DataBase();

      require 'szemely.php';
      $szemely = new Szemely($db);
      require 'Osztaly.php';
      
      

      $eredmeny = "";
      $erredmenyszoveggek = array(
            "Nincs ilyen felgaználónév",
            "Sikertelen belépés: hibás jelszó",
            "Sikeres belépés"
      );

      if (isset($_POST['felhnev']) && isset($_POST['jelszo'])) {
        $login =$szemely->checkLogin($_POST['felhnev'],$_POST['jelszo']);
        $eredmeny = $erredmenyszoveggek[$login];
      }
      echo $eredmeny;
    ?>
</head>
<body>
    <?php 
        if(!(isset($_SESSION['id']))){
        echo'<form action="belep.php" method="POST">
            Name :<input type="text" name="felhnev" placeholder="Írd be a felhasználonevet" require="required"><br>
            Jelszó: <input type="password" name="jelszo" placeholder="Írd be a jelszót" require="required">
            <input type="submit" style="margin-top: 2%;" >
        </form>';

        }else{
            echo'<form class="elem text-center" method="post" action="profilupload.php" enctype="multipart/form-data">
                  Profilkép feltöltés 
                  <input type="file" name="porfilkep" id="fileToUpload">
                  <input type="submit" value="feltöltés" name="submit">
                </form>';
        }
    ?>
    <button><a href="index.php">VISSZA</a></button>
</body>
</html>