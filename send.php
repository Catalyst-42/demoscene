<?php
    $str = $_POST['str'];
    echo $str;
    $ff = file_put_contents('data.php', '<p>' . $str . '</p>', FILE_APPEND);
    echo $ff
?>