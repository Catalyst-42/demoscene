<?php
    include_once('index.html');

    include_once('data.php');

    $str = $_POST['num1'];
    $fd = file_get_contents('data.txt');
    echo $fd;
    file_put_contents('data.txt', $str, FILE_APPEND)
?>