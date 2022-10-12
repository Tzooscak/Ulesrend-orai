<?php
//require_once 'db.inc.php';
class Szemely{
    private $szemelyid;
    private $nev;

    private $db;
    function __construct($db){
        $this->db = $db;
    }
    public function getNev($szemelyid, $db){
        $sql = "SELECT nev FROM `szemelyek` Where szemelyid=".$szemelyid;
                  if ($resultnev = $db->dbSelect($sql)){     
                    $szemelySor = $resultnev->fetch_assoc();
                    $this->nev = $szemelySor['nev'];
                    $this->szemelyid = $szemelyid;
                  }
        return $this->nev;
    }


    public function nevetKeres($szoveg){
        $talalatok = array();
        echo $sql="SELECT osztyalID FROM `szemelyek`WHERE `nev` LIKE '%$szoveg%'";
        if ($result = $db->dbSelect($sql)) {
            while($row = $result->fetch_assoc()){
                $osztalyok[$row['szemelyid']] = $row['nev'];
            }
        }
        return $talalatok;
    }
}
?>