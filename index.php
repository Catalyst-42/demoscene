<?php    
    include_once('index.html');

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $link = new mysqli($server, $username, $password, $db);

    $sql = 'SELECT comment FROM near';
    $result = mysqli_query($link, $sql);

    if ($result == false) {
        echo '<br>результат ложный';
    }

    while ($row = mysqli_fetch_array($result)) {
        echo "Город: " . $row['comment'] . "<br>";
    }
?>