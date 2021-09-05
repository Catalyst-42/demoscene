<?php
    $str = $_POST['str'];
    echo $str;
    // file_put_contents('data.php', '<p>' . $str . '</p>', FILE_APPEND);
    // include_once('data.php');

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $link = new mysqli($server, $username, $password, $db);

    $sql = "INSERT INTO near SET comment = '" . $str . "'";
    $result = mysqli_query($link, $sql);

    if ($result == false) {
        echo "Произошла ошибка при выполнении запроса";
        echo mysqli_error($link);
    }

?>