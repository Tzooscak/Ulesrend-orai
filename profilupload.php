<?php 
    session_start();
    $target_dir = "uploads/";
    $target_file = $target_dir . $_SESSION['id'].".png";

    if (move_uploaded_file($_FILES["porfilkep"]["tmp_name"], $target_file)){
        echo "the file ". htmlspecialchars($_FILES["porfilkep"]["tmp_name"])." has benn updated.";
    }
    else
        echo "nem jó";
?>