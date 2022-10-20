<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="upload.css">
    
    <title>Document</title>
</head>
<body>
    <div class="gallery "><?php
    // (B) GET IMAGES IN GALLERY FOLDER
    $dir = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $images = glob("$dir*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
    
    // (C) OUTPUT IMAGES
    foreach ($images as $i) {
        printf("<img src='uploads/%s'>", rawurlencode(basename($i)));
    }
    ?> </div>
    <button><a href="index.php">Fő oldal</a></button>
</body>
</html>