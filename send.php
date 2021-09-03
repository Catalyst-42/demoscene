<?php
    $str = $_POST['str'];
    echo $str;
    $file = fopen('data.php', 'r+');
    fwrite($file, $str);
    fclose($file);
?>