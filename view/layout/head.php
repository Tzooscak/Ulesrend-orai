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
        if(isset($_GET['osztyalID'])){
            $osztalyka = $_GET['osztyalID'];
          }
          ?>
            <nav class="navbar navbar-expand-lg" style="background-color: rgba(17, 65, 47, 0.541);">
              <div class="container-fluid">
                <?php
                 if (isset($_SESSION['id'])) {
                printf("<img style='display: inline;' class='shadow' src='uploads/".$_SESSION['id']."'>");
                $target_dir = "uploads/";
                $target_file = $target_dir . $_SESSION['id'];
                }
                ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <?php
                      if (isset($_SESSION['id'])) {
                        echo "<button><a href='view/felhasznalo/belep.php?action=kilepes'>KILEPES</a></button>";
                        
                      }else{
                        echo "<button><a href='view/felhasznalo/belep.php'>BELÉPÉS</a></button>";
                      }
                      ?>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="../">HOME</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Osztalyok
                      </a><?php
                      foreach($osztalyok as $kulcs => $ertek)
                        if($kulcs != $osztalyka){
                          echo '<ul class="dropdown-menu">
                            <li><a class="dropdown-item" href=index.php?osztyalID='.$kulcs.'>'.$ertek.'</a></li>
                            </ul>';
                          }
                          ?>
                    </li>
                  </ul>
                  <form class="d-flex" role="search" method="post" action="?page=felhasznalo&action=kereses">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                  <?php
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
                </div>
              </div>
            </nav>
    
</body>
