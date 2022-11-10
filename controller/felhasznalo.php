<?php
        session_start();
        require_once '../db.inc.php';
        $db = new Database();
        require_once '../model/szemely.php';
        $szemely = new Szemely($db);

        require_once '../model/Osztaly.php';
        $erredmenyszoveggek = array(
            "Nincs ilyen felgaználónév",
            "Sikertelen belépés: hibás jelszó",
            "Sikeres belépés"
        );
        $eredmeny="";
        
        $action =""; 

        if (isset($_REQUEST['action'])){
            $action = $_REQUEST['action'];
        }

        //$action = isset($_REQUEST['action']) ? $_REQUEST['action']:"";

        switch ($action) {
            case 'kilepes':
                session_unset();
                $eredmeny = "Sikeres kilpés";
            break;

            case 'belepes':
                if (isset($_POST['felhnev']) && isset($_POST['jelszo'])) {
                    $login =$szemely->checkLogin($_POST['felhnev'],$_POST['jelszo']);
                    //$eredmeny = $erredmenyszoveggek[$login];
                }
            break;

            case 'feltoltes':
                $target_dir = "uploads/";
                $target_file = $target_dir . $_SESSION['id'].'.jpg';

                if(move_uploaded_file($_FILES["profilkep"]["tmp_name"], $target_file)){
                    echo 'The file '.$_SESSION['id'].' has been uploaded.';
                } else {
                    echo 'There was an error uploading your file.';
                }
            break;
        }

        //require '../view/belep.php';
        
        
    ?>