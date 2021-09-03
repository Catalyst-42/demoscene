<?php
    $str = $_POST['str'];
    echo $str;
    file_put_contents(__DIR__.'data.txt', '<p>' . $str . '</p>', FILE_APPEND);
    include_once('data.php');
?>
