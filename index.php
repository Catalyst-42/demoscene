<?php    
    include_once('index.html');
    include_once('data.php');

    $link = mysqli_connect("us-cdbr-east-04.cleardb.com", "bae47087acc5a8", "69125eeb");
    $sql = 'SELECT comment FROM near;';
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "Город: " . $row['comment'] . "<br>";
    }
?>