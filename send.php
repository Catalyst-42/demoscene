<?php
    if (isset($_POST['str'])) { $str = $_POST['str']; } else { $str = ''; }
    $id = $_POST['id'];

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    try {
        $link = new mysqli($server, $username, $password, $db);
    } catch (PDOException $e){
        exit();
    }

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($link, "utf8");

    // scripts and styles temporarily forbidden
    // $str = strip_tags($str, "<b><s><u><i><a><pre><style><p><div><marquee><h1><h2><h3><span>");
    $str = str_replace("$", "[deleted]", $str); // hi
    if ($str != '') {
        $sql = "INSERT INTO near(comments, data) VALUES ('$str', NOW())";
        $result = mysqli_query($link, $sql);
    }

    $sql = "SELECT comments, data, id FROM near WHERE id>'$id' ORDER BY id";
    $result = mysqli_query($link, $sql);
    $types = array();
    while($row =  mysqli_fetch_assoc($result)) {
        array_push($types, array('comments' => $row['comments'], 'data' => $row['data'], 'id' => $row['id']));
    }
    
    echo json_encode($types, JSON_UNESCAPED_UNICODE);
?>
