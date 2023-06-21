<?php
include 'ImageResize.php';

use \Gumlet\ImageResize;


if (!empty($_FILES)) {
    $path = BIG_IMGS . $_FILES['myfile']['name'];
    $path2 = SMALL_IMGS . $_FILES['myfile']['name'];

    //Проверка существует ли файл
    if (file_exists($path)) { echo "Файл $path существует, выберите другое имя файла!"; exit;}

    //Проверка на размер файла
    if($_FILES["myfile"]["size"] > 1024*1*1024)
    {
        echo ("Размер файла не больше 5 мб");
        exit;
    }

    //Проверка расширения файла
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
    foreach ($blacklist as $item) {
        if(preg_match("/$item\$/i", $_FILES['myfile']['name'])) {
            echo "Загрузка php-файлов запрещена!";
            exit;
        }
    }

    //Проверка на тип файла
    $imageinfo = getimagesize($_FILES['myfile']['tmp_name']);
    if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
        echo "Можно загружать только jpg-файлы, неверное содержание файла, не изображение.";
        exit;
    }

    if($_FILES['myfile']['type'] != "image/jpeg") {
        echo "Можно загружать только jpg-файлы.";
        exit;
    }

    if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
        $message = "ok";
        $image = new ImageResize(BIG_IMGS . $_FILES['myfile']['name']);
        $image->resizeToWidth(150);
        $image->resizeToHeight(150);
        $image->save(SMALL_IMGS . $_FILES['myfile']['name']);
    }

    header("Location: gallery");
    die();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="myfile">
    <input type="submit" value="Загрузить">
</form>
</body>
</html>

<?php foreach ($gallery as $filename): ?>
    <a rel="gallery" class="photo" href="img/big/<?= $filename ?>"><img
            src="img/small/<?= $filename ?>" alt="img"/></a>
<?php endforeach; ?>
