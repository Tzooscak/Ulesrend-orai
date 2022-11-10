<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../upload.css">
    <title>Belepes</title>
    <?php
    //adatbázis
     
    ?>
</head>
<body>
    <?php 
        include_once '../controller/felhasznalo.php';
        echo $eredmeny;
        if(!(isset($_SESSION['id']))){
        echo'<form action="?action=belepes" method="POST">
            Name :<input type="text" name="felhnev" placeholder="Írd be a felhasználonevet" require="required"><br>
            Jelszó: <input type="password" name="jelszo" placeholder="Írd be a jelszót" require="required">
            <input type="hidden" value="action" name="belepes">
            <input type="submit" style="margin-top: 2%;" >
        </form>';

        }else{
            echo'<form class="elem text-center" method="post" action="?action=feltoltes" enctype="multipart/form-data">
                  Profilkép feltöltés 
                  <input type="file" name="porfilkep" id="fileToUpload">
                  <input type="submit" value="feltöltés" name="submit">
                </form>';
        }
        if (isset($_SESSION['id'])) {
            echo "<button><a href='../'>Fömenü</a></button>";
            printf("<img style='display: inline;' class='shadow' src='uploads/".$_SESSION['id'].".png'>");
            echo "<div style='display: inline;'>üdv néged senkiházi ".$_SESSION['nev']." !</div>";
            $target_dir = "uploads/";
            $target_file = $target_dir . $_SESSION['id'].".png";
        }
          
    ?>
</body>
</html>