<?php
    $str = $_POST['str'];
    $dt = file_get_contents('data.php');
    echo $str . $dt;
    file_put_contents('data.php', '<p>' . $str . "</p>", FILE_APPEND);
?>