<?php
define('TEMPLATES_DIR', '../templates/');
define('LAYOUTS_DIR', 'layouts/');
define('BIG_IMGS', $_SERVER['DOCUMENT_ROOT'] . "/img/big/");
define('SMALL_IMGS', $_SERVER['DOCUMENT_ROOT'] . "/img/small/");

/* DB config */
define('HOST', 'localhost:3306');
define('USER', 'root');
define('PASS', '');
define('DB', 'webis');

include "../engine/db.php";
include "../engine/function.php";
include "../engine/catalog.php";
include "../engine/menu.php";
include "../engine/news.php";
include "../engine/gallery.php";
include "../engine/lesson20.php";
