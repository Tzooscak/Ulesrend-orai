<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/cc8086a372.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="BootStyle.css">
    <?php
    //adatbázis
      include 'db.inc.php';
      
      
      $db = new DataBase();

      require 'szemely.php';
      $szemely = new Szemely($db);
      require 'Osztaly.php';

    //orai anyag
      $osztalyka = "1";
    ?>

    <title>találati lista</title>

    <style>
      span {
        display:block;
      }
    </style>
</head>
<body>
  <?php
    if(isset($_POST['keresettnev'])) {
       if(strlen($_POST['keresettnev']) < 3){
        echo "<h2>Írj be legaéább 3 karaktert a kereséshez!</h2>";
       }
       else{
            if($talalatkak = $szemely->nevetKeres($_POST['keresettnev'])){
                    foreach($talalatkak as $key => $nev){
                        //echo $nev."<br>";
                        echo '<h2><a href="\index.php?szemelyId='.$key.'">'.$nev.'</a></h2>'."<br>";
                        
                    }
            }else{
                    echo "<h2>A ".$_POST['keresettnev']." nem található!</h2>";
                    
                }}
        echo "<button><a href=index.php>Vissza</a></button>";
 
    /*$sql='SELECT szemelyid,nev FROM `szemelyek` WHERE nev LIKE "%'.$_POST['keresettnev'].'%"';  

    if ($result = $db->dbSelect($sql)) {
    while($row = $result->fetch_assoc()){
        
    }*/
    
}
            ?>
        
    </div>
</body>
</html>