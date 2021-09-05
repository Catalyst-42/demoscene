<?php
    $str = $_POST['str'];
    echo $str;
    // file_put_contents('data.php', '<p>' . $str . '</p>', FILE_APPEND);
    // include_once('data.php');

    $link = mysqli_connect("us-cdbr-east-04.cleardb.com", "bae47087acc5a8", "69125eeb");

    $sql = "INSERT INTO near SET comment = '" . $str . "'";
    $result = mysqli_query($link, $sql);

    if ($result == false) {
        echo "Произошла ошибка при выполнении запроса";
        echo mysqli_error($link);
    }

?>