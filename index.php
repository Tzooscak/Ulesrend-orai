<?php
  session_start();
?>
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

      
      
      
      $osztalyPeldany = new Osztaly($osztalyka,$db);
      $osztalyok = $osztalyPeldany->getALL($db);
      
    $kulcsok=array_keys($osztalyok);
    if(isset($_GET['osztyalID'])){
      $osztalyka = $_GET['osztyalID'];
    }
    if (isset($_GET['szemelyId'])){
      if ($szemelyOszatlya = $szemely->getOsztaly($_GET['szemelyId'])){
        $osztalyka = $szemelyOszatlya;
        }
    }
    

    
    ?>
    <title><?php echo $osztalyok[$osztalyka]; ?></title>

    <style>
      span {
        display:block;
      }
    </style>
</head>
<body>
  
  <?php

  
  if(isset($_POST['keresettnev'])){
    

    if ($result = $db->dbSelect($sql)) {
      $row = $result->fetch_assoc();
      $osztalyka = $row['osztyalID'];
    }else{
      echo "No record found";
      echo "Error in ".$sql."<br>".$conn->error;
      
  }
}

    
  
  //SELECT * FROM `szemelyek`
  //INNER JOIN sorok ON (szemelyek.nev = sorok.név1 OR szemelyek.nev = sorok.név2 OR szemelyek.nev = sorok.név3 OR szemelyek.nev = sorok.név4 OR szemelyek.nev = sorok.név5 OR szemelyek.nev = sorok.név6) WHERE szemelyek.nev LIKE "ede"
  if (isset($_SESSION['id'])) {
    echo "<button><a href='belep.php?kilepes=1'>KILEPES</a></button>";
    printf("<img style='display: inline;' class='shadow' src='uploads/".$_SESSION['id'].".png'>");
    echo "<div style='display: inline;'>üdv néged senkiházi ".$_SESSION['nev']." !</div>";
    
  }else{
    echo "<button><a href='belep.php'>BELÉPÉS</a></button>";
  }
  $target_dir = "uploads/";
  $target_file = $target_dir . $_SESSION['id'].".png";
  

  if(isset($_GET['osztyalID'])){
        $osztalyka = $_GET['osztyalID'];
      }
  foreach($osztalyok as $kulcs => $ertek){
    if($kulcs != $osztalyka){
      echo "<button type='button' style='float: right;'><a href='index.php?osztyalID=$kulcs'>$ertek</a><br></button>";
    }
   

  
    } 
    if(array_key_exists($osztalyka, $osztalyok)){
      echo '<div class="col-md-12"><div class="elem text-center">Vetitő</div></div>';
      echo '<form class="elem text-center" method="post" action="lista.php">
        Name: <input type="text" name="keresettnev">
        <input type="submit">
      </form>';
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // collect value of input field
      $name = $_POST['keresettnev'];
      if (empty($name)) {
        echo "Name is empty";
      } else {
        print_r ($_POST);
      }
    }
  ?>
    <div class="container">
        <div class="row">
            

            <?php
          $sajat =array('sorid' =>28, 'mezoneve' => 'név1');
          $colum = 0;
          $sql = "SELECT sorid,név1,név2,név3,név4,név5,név6 FROM `sorok` Where osztyalID=".$osztalyka;
          //$result = $db->conn->query($sql);
          if ($result = $db->dbSelect($sql)) {
            echo "<div class='row'>";
            while($row = $result->fetch_assoc()){
              for($colum = 1;$colum<7;$colum++){
                $nev = "-";
                $mezonev = 'név'.$colum;
                if ($row[$mezonev] != null){
                  $nev=$szemely->getNev($row[$mezonev],$db);
                  //$sql = "SELECT nev FROM `szemelyek` Where szemelyid=".$row[$mezonev];
                  /*if ($result2 = $db->dbSelect($sql)) {
                    $szemelySor = $result2->fetch_assoc();
                    $nev = $szemelySor['nev'];
                  }*/
              }
                
                  $bg ="";
                  if(isset($_GET['szemelyId'] )){
                    if($_GET['szemelyId']== $row[$mezonev])
                    $bg = "background-color: yellow";
                  }
                  if ($row['név'.$colum] !=null){
                  $nev = $szemely->getNev($row[$mezonev],$db);
                  
                  if ($row['sorid']==$sajat['sorid'] and $sajat['mezoneve']=='név'.$colum){
                    echo "<div class='col-md-2'><div class='elem text-center' style='color: blue;$bg' id='bel'><i class='fa-solid fa-desktop fa-5x'></i><span>".$nev."</span></div></div>";
                  }
                  else{
                    echo "<div class='col-md-2'><div class='elem text-center' ' id='bel' style='$bg'><i class='fa-solid fa-desktop fa-5x'></i><span>".$nev."</span></div></div>";
                  }}
                  else
                    echo '<div class="col-md-2" ></div>';
            }
           } echo "</div>";
          }else {
            echo "0 results";
          }
          /*if(array_key_exists($osztalyka, $osztalyok)){
            foreach($osztalyok[$osztalyka] as $sorok){
              echo "<div class='row'>";
              foreach($sorok as $tanulo){
                if($tanulo!="")
                  if($tanulo==$sajat)
                    echo "<div class='col-md-2'><div class='elem text-center' style='background-color: Blue;' id='bel'><i class='fa-solid fa-desktop fa-5x'></i><span>$tanulo</span></div></div>";
                  else
                    echo "<div class='col-md-2'><div class='elem text-center' id='bel'><i class='fa-solid fa-desktop fa-5x'></i><span>$tanulo</span></div></div>";
                  
                else
                  echo '<div class="col-md-2"></div>';
                }
              
              echo "</div>";
            }
          }
          else
            echo "sajt";*/
            
          echo '<form class="elem text-center" method="post" action="upload.php" enctype="multipart/form-data">
                  <input type="file" name="fileToUpload" id="fileToUpload">
                  <input type="submit" value="feltölt" name="submit">
                </form>';
          echo '<button type="button"><a href="gallery.php">Kép galléria</a><br></button>';
        
        
        
            
            ?>
        
    </div>
</body>
</html>