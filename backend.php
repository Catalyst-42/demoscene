<?php
    include_once('index.html');
    include_once('data.php');
    
    $str = $_POST['num1'];
    file_put_contents('data.php', '\n<p>' . $str . '<\p>', FILE_APPEND)
?>