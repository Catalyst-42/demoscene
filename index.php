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
      <a class="link" style="top: 16px;" href='http://192.168.1.39:8080/Demoscene/information.html'><u>i</u></a>
      <a class="link" style="top: 38px; font-size: 16px" onclick="toTop()"><u>&lt;</u></a>
      <a class="link" style="top: 64px; font-size: 16px" onclick="toBottom()"><u>&gt;</u></a>
  
      <a class="link standart" style="top: 112px; font-size: 16px" onclick="setTheme('standart')">S</a>
      <a class="link dark" style="top: 136px; font-size: 16px" onclick="setTheme('dark')">D</a>
      <a class="link gradient" style="top: 160px; font-size: 16px" onclick="setTheme('gradient')">R</a>
      <a class="link hacker" style="top: 184px; font-size: 16px" onclick="setTheme('hacker')">H</a>
      <a class="link black" style="top: 208px; font-size: 16px" onclick="setTheme('black')">B</a>
    </head>
    
    <body class="black">
      <div class='comments' id='0'>
    END;

    $link = new mysqli('127.0.0.1', 'u0_a614', 'root', 'near');
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      echo "<pre class='comment' id='0'><span class='bg'>._.</span><br>Database is down...</pre>"; 
      exit();
    }
    else {
      mysqli_set_charset($link, "utf8");
      $sql = 'SELECT comments, data, id FROM near ORDER BY id';
      $result = mysqli_query($link, $sql);
  
      while ($row = mysqli_fetch_array($result)) {
          echo "<pre class='comment' id='" . $row['id'] . "'>" . "<span class='bg'>" . $row['data'] . '</span><br>'. $row['comments'] . "</pre>"; 
      }
    }

    echo <<< END
    </div>
      <div><textarea spellcheck="false" maxlength="1023" class='input' cols="40" rows="8"></textarea></div>
      <input type="submit" class="send button" value="ADD">
      
      <script src="script.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="animation.js"></script>
    </body>
    </html>
    END;
?>
