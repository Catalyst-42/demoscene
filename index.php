<?php
    $str = $_POST['str'];
    file_put_contents('data.php', '<p>' . $str . "</p>", FILE_APPEND);
    
    include_once('index.html');
    include_once('data.php');
?>