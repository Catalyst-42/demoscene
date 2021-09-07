<?php
    $str = $_POST['str'];
    echo $str;

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $link = new mysqli($server, $username, $password, $db);
    mysqli_set_charset($link, "utf8");

    $sql = "INSERT INTO near(comment, data) VALUES ('$str', NOW())";
    $result = mysqli_query($link, $sql);

    $sql = "SELECT * FROM near ORDER BY id DESC LIMIT 0, 1";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    $data[] = $row;

    echo json_encode($data);
?>