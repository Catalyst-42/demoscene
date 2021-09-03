<?php
    include_once('index.html');

    $str = $_GET['num1'];
    $fd = file_get_contents('data.txt');
    echo $fd;
    file_put_contents('data.txt', $str, FILE_APPEND)
?>