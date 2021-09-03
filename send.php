<?php
    $str = $_POST['str'];
    file_put_contents('data.php', '<p>' . $str . "</p>", FILE_APPEND);
    echo $str;
?>