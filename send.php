<?php
    $str = $_POST['str'];
    echo $str;
    file_put_contents('data.php', '<p> new data </p>', FILE_APPEND);
?>