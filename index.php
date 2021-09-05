<?php    
    include_once('index.html');
    include_once('data.php');

    $link = mysqli_connect("us-cdbr-east-04.cleardb.com", "bae47087acc5a8", "69125eeb");

    if ($link == false) {
        echo "Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error();
    }
    else {
        echo "Соединение установлено успешно";
        mysqli_set_charset($link, "utf8");
    }

    $sql = 'SELECT comment FROM near;';
    $result = mysqli_query($link, $sql);

    if ($result == false) {
        echo 'результат ложный';
    }

    while ($row = mysqli_fetch_array($result)) {
        echo "Город: " . $row['comment'] . "<br>";
    }
    echo $result;
?>