<?php
    class Osztaly{
    private $osztyalID;
    private $OsztalyNev;

    private $db;
    function __construct($osztyalID,$db){
        $sql = "SELECT nev FROM `szemelyek` Where szemelyid=".$osztyalID;
                  if ($result = $db->dbSelect($sql)){     
                    $szemelySor = $result->fetch_assoc();
                    $this->OsztalyNev = $szemelySor['OsztalyNev'];
                    $this->osztyalID = $osztyalID;
                  }
    }
    public function getOsztalyNev(){
        return $this->OsztalyNev;
    }
    public function getALL($db){
        $osztalyok = array();
        $sql = "SELECT osztyalID,OsztalyNev FROM `osztalyok`";
            if ($result = $db->dbSelect($sql)) {
                while($row = $result->fetch_assoc()){
                    $osztalyok[$row['osztyalID']] = $row['OsztalyNev'];
                }
    }
    return $osztalyok;
    }
    
}
?>