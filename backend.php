<?php
    $str = $_GET['num1'];
    echo $str;
    $fd = fopen("hello.txt", 'w') or die("не удалось создать файл");
    fwrite($fd, $str);
    fclose($fd);
?>