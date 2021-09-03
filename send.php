<?php
    $str = $_POST['str'];
    echo $str;
    file_put_contents('data.php', '<p>' . $str . '</p>', FILE_APPEND);
    include_once('data.php');
?>
