<?php    
    echo <<< END
    <!DOCTYPE html>
    <html lang="ru">
    <head>
      <!-- подключение основных плюшек и шрифтов style.css -->
      <meta content='width=device-width, initial-scale=1' name='viewport'/>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="effects.css">
      <link rel="icon" type="image/png" href="./images/DemosceneBig.png">
      <link rel="apple-touch-icon" type="image/png" href="./images/DemosceneBig.png">
      
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet">
      
      <title>Demoscene</title>
    </head>
    
    <body>
      <a class='information' href='https://demoscene.herokuapp.com/information.html'>i</a>
      <div class='comments' id='0'>
    END;

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
    $sql = 'SELECT comments, data, id FROM near ORDER BY id';
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<p class='comment' id='" . $row['id'] . "'>" . "<span class='bg'>" . $row['data'] . '</span><br>'. $row['comments'] . "</p>"; 
    }
    
    echo <<< END
    </div>
      <div><textarea maxlength="1023" class='input' cols="40" rows="8"></textarea></div>
      <input type="submit" class="send button" value="ADD">
      <!-- подключение мозгов сайта script.js --> 
      <script src="script.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="animation.js"></script>
    </body>
    </html>
    END;
?>
