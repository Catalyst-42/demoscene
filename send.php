<?php
    if (isset($_POST['str'])) { $str = $_POST['str']; } else { $str = ''; }
    $id = $_POST['id'];

    printf("His message: ", $str);

?>
