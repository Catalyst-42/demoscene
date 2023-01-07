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

    $str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str);
    
    // standard tags
    $str = preg_replace('/\[(\/?([subi]))]/', '<${1}>', $str);
    
    // custom tags
    $str = preg_replace('/\[((rainbow|magic|silver|jump|shake))]/', '<span style="${1}-animated">', $str);
    $str = preg_replace('/\[(\/(rainbow|magic|silver|jump|shake|))]/', '</span>', $str);
    
    // colors
    $str = preg_replace('/\[(([0-9a-fA-F]{3}){1,2})\]/', '<span style="color: ${1}">', $str);

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
