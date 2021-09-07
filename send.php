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
    
    echo "<meta http-equiv='refresh' content='0'>";
    include_once('index.html');

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $link = new mysqli($server, $username, $password, $db);
    mysqli_set_charset($link, "utf8");

    $sql = 'SELECT comment, data, id FROM near ORDER BY id';
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<p class='comment' id='" . $row['id'] . "'>" . $row['data'] . '<br>'. $row['comment'] . "</p>";
    }
?>