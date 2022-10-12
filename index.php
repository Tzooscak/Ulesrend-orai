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

        
      
      /*$osztalykasa =  array("13I" => array(
                          array("Senki","Senki","Senki",null,"Béla","Bujdi"),
                          array("Beni","Erik","Szabi",null,"Senki","Horvát"),
                          array("Kori","Tokris","Iványi",null,"Pinyő","ede"),
                          array(null,null,null,"Tanár úr","Senki","Oláh")
                      ),
                      "13CE" => array(
                          array("Senki","Jozsi","Senki","Sanyi","Kenyér","Laci"),
                          array("Lisztes","Darco",null,null,"Lajos",null),
                          array(null,null,"Janos",null,"Mirka","Brika"),
                          array(null,"Ili","Mili","Tanár úr","Sajtos","Majkos")
                    )
      );*/
      /*foreach($nevek["13I"] as $sor){
        //foreach($sorok as $tanulo){
      $sql = "INSERT INTO sorok (osztyalID,név1, név2,név3, név4,név5, név6 ) 
      VALUES (1,'$sor[0]', '$sor[1]', '$sor[2]', '$sor[3]', '$sor[4]', '$sor[5]')";
        //}
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      }
      foreach($nevek["13CE"] as $sor){
        //foreach($sorok as $tanulo){
      $sql = "INSERT INTO sorok (osztyalID,név1, név2,név3, név4,név5, név6 ) 
      VALUES (2,'$sor[0]', '$sor[1]', '$sor[2]', '$sor[3]', '$sor[4]', '$sor[5]')";
        //}
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      }*/
      $osztalyPeldany = new Osztaly($osztalyka,$db);
      $osztalyok = $osztalyPeldany->getALL($db);
      
    $kulcsok=array_keys($osztalyok);
    if(isset($_GET['osztyalID'])){
      $osztalyka = $_GET['osztyalID'];
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
    $sql='SELECT osztyalID FROM `szemelyek`
    INNER JOIN sorok ON `szemelyid` = `sorok`.`név1` OR 
                          `szemelyid` = `sorok`.`név2` OR 
                          `szemelyid` = `sorok`.`név3` OR 
                          `szemelyid` = `sorok`.`név4` OR 
                          `szemelyid` = `sorok`.`név5` OR 
                          `szemelyid` = `sorok`.`név6`
                          WHERE `nev` LIKE "'.$_POST['keresettnev'].'%"';  

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
      echo '<form class="elem text-center" method="post" action="'.$_SERVER['PHP_SELF'].'">
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
                if ($row['név'.$colum] !=null){
                  if ($row['sorid']==$sajat['sorid'] and $sajat['mezoneve']=='név'.$colum)
                    echo "<div class='col-md-2'><div class='elem text-center' style='background-color: Blue;' id='bel'><i class='fa-solid fa-desktop fa-5x'></i><span>".$nev."</span></div></div>";
                  else
                    echo "<div class='col-md-2'><div class='elem text-center' ' id='bel'><i class='fa-solid fa-desktop fa-5x'></i><span>".$nev."</span></div></div>";
                  }
                  else
                    echo '<div class="col-md-2"></div>';
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
            
            ?>
        
    </div>
</body>
</html>