  <?php
      $head = $osztalyok[$osztalyka];
      include_once 'view/layout/head.php';
  ?>
<body>
  <?php
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
                    if (isset($_SESSION['id'])){
                      echo "<div class='col-md-2'><div class='elem text-center' style='color: blue;$bg' id='bel'><img style='display: inline;' class='shadow' src='uploads/24.png'><span>".$nev."</span></div></div>";
                    }
                    else{
                    echo "<div class='col-md-2'><div class='elem text-center' style='color: blue;$bg' id='bel'><i class='fa-solid fa-desktop fa-5x'></i><span>".$nev."</span></div></div>";
                    }
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