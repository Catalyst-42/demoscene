<?php    
  echo <<< END
  <!DOCTYPE html>
  <html lang="ru">
  <head>
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
    <a class="link" style="top: 16px;" href='information.html'><u>i</u></a>
    <a class="link" style="top: 38px; font-size: 16px" onclick="toTop()"><u>&lt;</u></a>
    <a class="link" style="top: 64px; font-size: 16px" onclick="toBottom()"><u>&gt;</u></a>
    
    <!-- 112, 136, 160, 184, 208 -->
    <a class="link standart" style="top: 112px; font-size: 16px" onclick="setTheme('standart')">S</a>
    <a class="link black" style="top: 136px; font-size: 16px" onclick="setTheme('black')">B</a>
  </head>
  
  <body class="black">
    <div class='comments' id='0'>
  END;

  try {
    $link = new mysqli(getenv('DATABASE_URL'), getenv('USER'), getenv('PASSWORD'), 'near');

    mysqli_set_charset($link, "utf8");
    $sql = 'SELECT comments, data, id FROM near';
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
      echo "<pre class='comment' id='" . $row['id'] . "'>" . "<span class='bg'>" . $row['data'] . '</span><br>'. $row['comments'] . "</pre>";
    }

    echo <<< END
    </div>
    <div><textarea spellcheck="false" maxlength="1023" class='input' cols="40" rows="8"></textarea></div>
    <input type="submit" class="send button" value="ADD">
    END;
  }
  catch (Exception $e) {
    echo "<pre class='comment' id='0'><span class='bg'>._.</span><br>Database is down...</pre> </div>";
  }

  echo <<< END
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="animation.js"></script>
  </body>
  </html>
  END;
?>
