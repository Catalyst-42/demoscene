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
    
    // $result = mysqli_query($link,  "SELECT MAX(id) FROM near");
    // $row = mysqli_fetch_row($result);
    // echo $row[0];
    
    // echo $str;

    $sql = 'SELECT * FROM near ORDER BY id DESC LIMIT 0, 1';
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<p class='comment' id='" . $row['id'] . "'>" . $row['data'] . '<br>'. $row['comment'] . "</p>";
    }
?>