<?php

    function first(){
        $a = random_int(-10, 10);
        $b = random_int(-10, 10);

        echo "a = " . $a . " b = " . $b . " ";

        if ($a >= 0 && $b >= 0) {
            echo "Разность: " . ($a - $b) . "<br>";
        } elseif ($a < 0 && $b < 0) {
            echo "Произведение: " . ($a * $b) . "<br>";
        } else {
            echo "Сумма: " . ($a + $b);
        }
    }

    function second(){
        $a = random_int(0, 15);

        switch ($a) {
            case 0:
            echo "0 ";
            case 1:
            echo "1 ";
            case 2:
            echo "2 ";
            case 3:
            echo "3 ";
            case 4:
            echo "4 ";
            case 5:
            echo "5 ";
            case 6:
            echo "6 ";
            case 7:
            echo "7 ";
            case 8:
            echo "8 ";
            case 9:
            echo "9 ";
            case 10:
            echo "10 ";
            case 11:
            echo "11 ";
            case 12:
            echo "12 ";
            case 13:
            echo "13 ";
            case 14:
            echo "14 ";
            case 15:
            echo "15";
            break;
        }
    }

    function third_fourth(){
        function add($a, $b) {
            return $a + $b;
        }
        
        function subtract($a, $b) {
            return $a - $b;
        }
        
        function multiply($a, $b) {
            return $a * $b;
        }
        
        function divide($a, $b) {
            if ($b != 0) {
            return $a / $b;
            } else {
            echo "Нельзя делить на ноль!";
            }
        }

        $a = random_int(-10, 10);
        $b = random_int(-10, 10);

        echo "a = " . $a . " b = " . $b . " ";


        echo "Сумма $a и $b равна " . add($a, $b). "<br>";
        echo "Разность $a и $b равна " . subtract($a, $b) . "<br>";
        echo "Произведение $a и $b равно " . multiply($a, $b) . "<br>";
        echo "Частное $a и $b равно " . divide($a, $b) . "<br>";

        function mathOperation($arg1, $arg2, $operation) {
            switch ($operation) {
                case "add":
                return add($arg1, $arg2);
                break;
                case "subtract":
                return subtract($arg1, $arg2);
                break;
                case "multiply":
                return multiply($arg1, $arg2);
                break;
                case "divide":
                return divide($arg1, $arg2);
                break;
                default:
                return "Неверная операция!";
            }
        }

                
        echo "Сумма $a и $b равна " . mathOperation($a, $b, "add") . "<br>";

        echo "Разность $a и $b равна " . mathOperation($a, $b, "subtract") . "<br>";

        echo "Произведение $a и $b равно " . mathOperation($a, $b, "multiply") . "<br>";

        echo "Частное $a и $b равно " . mathOperation($a, $b, "divide") . "<br>";

        echo "Неверная операция: " . mathOperation($a, $b, "mod") . "<br>";
    }

    function fifth(){
        echo date('Y');

        $date = strftime("%Y год", time());
        include("date.php");

        $content = file_get_contents("date.html");
        $content = str_replace("{{ date }}", $date, $content);
        file_put_contents("date.html", $content);

        readfile("date.html");
    }

    function sixth(){
        function power($val, $pow) {
            if ($pow == 0) {
                return 1;
            }
            if ($pow == 1) {
                return $val;
            }
            if ($pow > 1) {
                return $val * power($val, $pow - 1);
            }
        }
        
        echo power(2, 3) . " \n";
        echo power(5, 2) . " \n";
        echo power(3, 0) . " \n";
    }
?>


<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <p><?php first() ?></p>
        <p><?php second() ?></p>
        <p><?php third_fourth() ?></p>
        <p><?php fifth() ?></p>
        <p><?php sixth() ?></p>        
    </body>
</html>