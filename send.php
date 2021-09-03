<?php
    $str = $_POST['str'];
    echo $str;
    $ff = file_put_contents(__DIR__.'data.txt', '<p>' . $str . '</p>', FILE_APPEND | FILE_USE_INCLUDE_PATH);
    echo $ff
?>
