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
        $stmt = $this->db->conn->prepare("SELECT nev FROM ".$this->db->prefix."_szemelyek Where szemelyid= ?");
        if ($stmt->bind_param('i',$szemelyid) === true){
            $stmt->execute();
                  if ($resultnev = $stmt->get_result()){
                    $szemelySor = $resultnev->fetch_assoc();
                    $this->nev = $szemelySor['nev'];
                    $this->szemelyid = $szemelyid;
                  }
        return $this->nev;
    }
    }


    public function nevetKeres($szoveg){
        $talalatok = array();
        $stmt = $this->db->conn->prepare("SELECT szemelyid,nev FROM ".$this->db->prefix."_szemelyek WHERE `nev` LIKE ?");
        if ($stmt->bind_param('s',$szoveg) === true) {
            $stmt->execute();
            while($row = $stmt->fetch_assoc()){
                $talalatok[$row['szemelyid']] = $row['nev'];
            }
        }
        return $talalatok;
    }

    public function getOsztaly($szemelyId){
        $sql = "SELECT `osztyalID` FROM sorok WHERE (";
        for($i=1;$i<=6;$i++){
            $sql .= "név$i = ".$szemelyId;
            if ($i<6){
                $sql .= " OR ";
            }
            else{
                $sql .= ")";
            }}

            if ($result = $this->db->dbSelect($sql)) {
                if($row = $result->fetch_assoc()){
                    return $row['osztyalID'];
            }}
    }

    /*public function getOsztaly($szemelyId): array {
        if($result = $this->db->dbSelect('SELECT * FROM sorok INNER JOIN osztalyok ON sorok.osztyalID = osztalyok.osztyalID WHERE szemelyid = "'.$szemelyId.'"')) {
            $row = $result->fetch_assoc();
            return [$row['szemelyid'] => $row['OsztalyNev']];
        } else {
            return [];
        }
    }*/
    public function checkLogin($felhNev, $jelszo){
            $sql='SELECT * FROM `szemelyek` WHERE felhasznaloNev ="'.$felhNev.'"';
                //van e ilyen nevü felhasználó?
                if ($result = $this->db->dbSelect($sql)) { 
                    if ($row = $result->fetch_assoc()) {
                        //jó ez a jelszó?
                        if($row['jelszo'] == md5($jelszo)){
                            $eredmeny =2; //"Sikeres belépés, üdv ".$row['nev'];
                            $_SESSION["nev"] = $row["nev"];
                            $_SESSION["id"] = $row["szemelyid"];
                        }
                        else{
                            $eredmeny =1; //"Sikertelen belépés: hibás jelszó";
                        }
                    }else{
                        $eredmeny=0;
                    }
                    return $eredmeny;
        }
    }
        

    }
    

?>