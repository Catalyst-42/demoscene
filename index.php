<?php    
    include_once('index.html');
    include_once('data.php');

    $link = mysqli_connect("us-cdbr-east-04.cleardb.com", "bae47087acc5a8", "69125eeb");
    $sql = 'SELECT comment FROM near;';
    $result = mysqli_query($link, $sql);
    
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);    
    foreach ($rows as $row) {
        echo "Город: " . $row['comment'] . "; Идентификатор: . <br>";
    }
?>