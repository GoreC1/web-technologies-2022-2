<?php
function declension($number, $word) {
    $hour_cases = array("час", "часа", "часов");
    $minute_cases = array("минута", "минуты", "минут");
    $cases = ($word == "час") ? $hour_cases : $minute_cases;
    $mod100 = $number % 100;
    if ($mod100 >= 11 && $mod100 <= 19) {
        return $cases[2];
    }
    $mod10 = $number % 10;
    if ($mod10 == 1) {
        return $cases[0];
    }
    if ($mod10 >= 2 && $mod10 <= 4) {
        return $cases[1];
    }
    return $cases[2];
}

function get_time() {
    $hour = date("G");
    $minute = date("i");
    $hour_word = declension($hour, "час");
    $minute_word = declension($minute, "минута");
    return "$hour $hour_word $minute $minute_word";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Текущее время</title>
</head>
<body>
    <p>Сейчас <?php echo get_time(); ?></p>
</body>
</html>