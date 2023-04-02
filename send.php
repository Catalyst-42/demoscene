<?php
    if (isset($_POST['str'])) { $str = $_POST['str']; } else { $str = ''; }
    $id = (int) $_POST['id'];

    try {
        $link = new mysqli(getenv('DATABASE_URL'), getenv('USER'), getenv('PASSWORD'), 'near');
    } catch (Exception $e) {
        exit();
    }

    mysqli_set_charset($link, "utf8");
    
    if ($str != '') {
        $str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str);
        
        // custom tags, colors, standard tags
        $str = preg_replace('/\[(rainbow|magic|blink|gold|bronze|silver|jump|shake)]((.|\n)+?)\[\/\]/', '<span class="${1}-animated">${2}</span>', $str);
        $str = preg_replace('/\[#(([0-9a-fA-F]{3}){1,2})\]((.|\n)+?)\[\/\]/', '<span style="color: #${1}">${3}</span>', $str);
        $str = preg_replace('/\[([subi])]((.|\n)+?)\[\/\1\]/', '<${1}>${2}</${1}>', $str);
        
        // non empty or image
        if (trim(strip_tags($str)) != '') {
            $str = preg_replace('/\[img\]([^"]+?)\[\/img\]/', '<img src="${1}"></img>', $str);

            $sql = $link->prepare('INSERT INTO near(comments, data) VALUES (?, NOW());');
            $sql->bind_param('s', $str);
            $sql->execute();
        
            $sql->close();
        }
    }

    $sql = "SELECT comments, data, id FROM near WHERE id>$id ORDER BY id;";
    $result = mysqli_query($link, $sql);
    $types = array();
    while($row = mysqli_fetch_assoc($result)) {
        array_push($types, array('comments' => $row['comments'], 'data' => $row['data'], 'id' => $row['id']));
    }

    echo json_encode($types, JSON_UNESCAPED_UNICODE);
?>
