<?php
    $str = $_POST['str'];
    file_put_contents('data.php', '<p>' . $str . "</p>", FILE_APPEND) or die("не удалось открыть файл");
    echo $str;
?>