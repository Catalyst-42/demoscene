<?php
    $str = $_POST['str'];
    
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    
    $link = new mysqli($server, $username, $password, $db);
    mysqli_set_charset($link, "utf8");
    
    $sql = "INSERT INTO near(comment, data) VALUES ('$str', NOW())";
    $result = mysqli_query($link, $sql);

    $sql = "SELECT MAX(id) FROM near";
    $result = mysqli_query($link, $sql);

    echo $str;
    echo mysqli_fetch_array($result);
?>