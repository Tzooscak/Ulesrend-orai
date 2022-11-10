    <?php
    
      session_start();

      require 'model/szemely.php';
      
      require 'model/Osztaly.php';

    //orai anyag
      $szemely = new Szemely($db);
      $osztalyka = "1";

    if(isset($_GET['osztyalID'])){
      $osztalyka = $_GET['osztyalID'];
    }
    if (isset($_GET['szemelyId'])){
      if ($szemelyOszatlya = $szemely->getOsztaly($_GET['szemelyId'])){
        $osztalyka = $szemelyOszatlya;
        }
    }

    $osztalyPeldany = new Osztaly($osztalyka,$db);
    $osztalyok = $osztalyPeldany->getALL($db);

    $sajat =array('sorid' =>28, 'mezoneve' => 'név1');

    if(!array_key_exists($osztalyka, $osztalyok)){
      $osztalyka = 1;
    }

    if(isset($_POST['keresettnev'])){
      if ($result = $db->dbSelect($sql)) {
        $row = $result->fetch_assoc();
        $osztalyka = $row['osztyalID'];
      }else{
        echo "No record found";
        echo "Error in ".$sql."<br>".$conn->error;
        
    }
    }

    if(isset($_GET['osztyalID'])){
        $osztalyka = $_GET['osztyalID'];
      }
  
    $sql = "SELECT sorid,név1,név2,név3,név4,név5,név6 FROM `sorok` Where osztyalID=".$osztalyka;
    $result = $db->dbSelect($sql);
          
    require './view/index.php';      
    ?>
        
    </div>
</body>
</html>