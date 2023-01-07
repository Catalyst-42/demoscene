<?php
    if (isset($_POST['str'])) { $str = $_POST['str']; } else { $str = ''; }
    $id = $_POST['id'];

    try {
        $link = new mysqli('127.0.0.1', 'u0_a614', 'root', 'near');
    } catch (PDOException $e) {
        exit();
    }

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link, "utf8");

    // $str = strip_tags($str, "<span><s><u><b><i>");
    $str = str_replace(array('<', '>'), array('&lt;', '&gt'), $str);

    if ($str != '') {
        $sql = $link->prepare('INSERT INTO near(comments, data) VALUES (?, NOW())');
        $sql->bind_param('s', $str);
        $sql->execute();

        $result = mysqli_query($link, $sql);
    }
    
    $sql = "SELECT comments, data, id FROM near WHERE id>'$id' ORDER BY id";

    $result = mysqli_query($link, $sql);
    $types = array();
    while($row = mysqli_fetch_assoc($result)) {
        array_push($types, array('comments' => $row['comments'], 'data' => $row['data'], 'id' => $row['id']));
    }
    
    echo json_encode($types, JSON_UNESCAPED_UNICODE);
?>
