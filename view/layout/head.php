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
    <title><?php echo $osztalyok[$osztalyka]; ?></title>
</head>
<body>
    <?php
        if (isset($_SESSION['id'])) {
            echo "<button><a href='view/belep.php?action=kilepes'>KILEPES</a></button>";
            printf("<img style='display: inline;' class='shadow' src='uploads/".$_SESSION['id'].".png'>");
            echo "<div style='display: inline;'>üdv néged senkiházi ".$_SESSION['nev']." !</div>";
            $target_dir = "uploads/";
            $target_file = $target_dir . $_SESSION['id'].".png";
          }else{
            echo "<button><a href='view/belep.php'>BELÉPÉS</a></button>";
          }
    ?>
</body>