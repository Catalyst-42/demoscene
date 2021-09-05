<?php    
    include_once('index.html');

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $link = new mysqli($server, $username, $password, $db);
    mysqli_set_charset($link, "utf8");

    $sql = 'SELECT comment FROM near ORDER BY id';
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<p>" . $row['comment'] . "</p>";
    }
?>
