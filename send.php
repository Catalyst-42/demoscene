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

    $str = str_replace(array('<', '>'), array('&lt;', '&gt'), $str);
    
    $styles_from = array('[s]', '[/s]', '[u]', '[/u]', '[b]', '[/b]', '[/i]', '[i]');
    $styles_to =   array('<s>', '</s>', '<u>', '</u>', '<b>', '</b>', '</i>', '<i>');
    $str = str_replace($styles_from, $styles_to), $str);
    
    $styles_from = array('[rainbow]', '[magic]', '[silver]', '[jump]', '[shake]');
    $styles_to =   array('rainbow', 'magic', 'silver', 'jump', 'shake');
    $str = str_replace($styles_from, '<span class="' . $styles_to . '-animated">'), $str);

    $styles_from = array('[/rainbow]', '[/magic]', '[/silver]', '[/jump]', '[/shake]');
    $str = str_replace($styles_from, '</span>'), $str);

    // [stroke] [/stroke]         -> [s] [/s]
    // [underlined] [/underlined] -> [u] [/u]
    // [bold] [/bold]             -> [b] [/b]
    // [itailc] [/italic]         -> [i] [/i]
    
    // [rainbow] [/rainbow] 
    // [magic] [/magic]
    // [silver] [/silver]
    // [jump] [/jump]
    // [shake] [/shake]
    
    // [fff] [\]
    // [ff00ff] [\]

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
