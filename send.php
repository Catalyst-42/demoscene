<?php
    if (isset($_POST['str'])) { $str = $_POST['str']; } else { $str = ''; }
    $id = (int) $_POST['id'];

    try {
        $link = new mysqli('127.0.0.1', 'u0_a614', 'root', 'near');
    } catch (Exception $e) {
        exit();
    }

    mysqli_set_charset($link, "utf8");
    
    if ($str != '') {
        $str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str);
        
        // standard tags
        $str = preg_replace('/\[(\/?([subi]))]/', '<${1}>', $str);
        
        // custom tags
        $str = preg_replace('/\[((rainbow|magic|silver|jump|shake))]/', '<span class="${1}-animated">', $str);
        $str = preg_replace('/\[(\/(rainbow|magic|silver|jump|shake|))]/', '</span>', $str);
        
        // colors
        $str = preg_replace('/\[(#([0-9a-fA-F]{3}){1,2})\]/', '<span style="color: ${1};">', $str);

        $sql = $link->prepare('INSERT INTO near(comments, data) VALUES (?, NOW());');
        $sql->bind_param('s', $str);
        $sql->execute();
    }
    
    $sql = $link->prepare('SELECT comments, data, id FROM near WHERE id>? ORDER BY id;');
    $sql->bind_param('i', $id);
    $sql->execute();

    $types = array();
    while($row = $sql->fetch()) {
        array_push($types, array('comments' => $row['comments'], 'data' => $row['data'], 'id' => $row['id']));
    }

    echo json_encode($types, JSON_UNESCAPED_UNICODE);
?>
