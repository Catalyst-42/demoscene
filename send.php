<?php
    $str = $_POST['str'];
    $id = $_POST['id'];

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $link = new mysqli($server, $username, $password, $db);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($link, "utf8");

    if ($str != '') {
        $sql = "INSERT INTO near(comment, data) VALUES ('$str', NOW())";
        $result = mysqli_query($link, $sql);
    }

    $sql = "SELECT comment, data, id FROM near WHERE id>'$id' ORDER BY id";
    $result = mysqli_query($link, $sql);
    $types = array();
    while($row =  mysqli_fetch_assoc($result)) {
        array_push($types, array('comment' => $row['comment'], 'data' => $row['data'], 'id' => $row['id']));
    }
    
    echo json_encode($types, JSON_UNESCAPED_UNICODE);
?>
