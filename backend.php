<?php
    $str = $_GET['num1'];
    echo $str;
    $fd = fopen("data.txt", 'r') or die("не удалось открыть файл");
    echo $fd;
    fclose($fd);
?>