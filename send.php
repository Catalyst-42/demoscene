<?php
    $str = $_POST['str'];
    echo $str;
    // file_put_contents('data.php', '<p>' . $str . '</p>', FILE_APPEND);
    // include_once('data.php');

    $link = mysqli_connect("us-cdbr-east-04.cleardb.com", "heroku_bae47087acc5a8", "69125eeb");

    if ($link == false) {
        echo "Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error();
    }
    else {
        print("Соединение установлено успешно");
        mysqli_set_charset($link, "utf8");
    }

    $sql = "INSERT near(comment) VALUES('" . $str . "')";
    $result = mysqli_query($link, $sql);

    if ($result == false) {
        echo "Произошла ошибка при выполнении запроса";
    }

?>