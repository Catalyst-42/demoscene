<?php
echo <<<END
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
  </head>

  <body class="black">
    <div class='comments' id='comments-container'>
  END;

try {
  $dsn = sprintf(
    'pgsql:host=%s;port=%s;dbname=%s',
    getenv('DEMOSCENE_DATABASE_URL'),
    getenv('DEMOSCENE_DATABASE_PORT'),
    getenv('DEMOSCENE_DATABASE_NAME')
  );
  $link = new PDO($dsn, getenv('DEMOSCENE_USER'), getenv('DEMOSCENE_PASSWORD'), array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ));
  $link->exec("SET NAMES 'UTF8'");

  $sql = $link->prepare('SELECT comment, birthtime, id FROM comments ORDER BY id');
  $sql->execute();

  while ($row = $sql->fetch()) {
    echo (
      "<pre class='comment' id='" . $row['id'] . "'>" .
        "<span class='bg'>" . $row['birthtime'] . ' | #' . $row['id'] . '</span><br>' .
        $row['comment'] .
      "</pre>"
    );
  }

  echo <<<END
    </div>
    <div><textarea spellcheck="false" class='input' cols="35" rows="8"></textarea></div>
    <input type="submit" class="send button" value="ADD">
  END;
} catch (Exception $e) {
  echo "<pre class='comment' id='0'><span class='bg'>._.</span><br>Database is down...</pre> </div>";
}

echo <<<END
    <!-- Links -->
    <a class="link" style="top: 16px;" href='information.html'><u>i</u></a>
    <a class="link" style="top: 38px; font-size: 16px" onclick="toTop()"><u>&lt;</u></a>
    <a class="link" style="top: 64px; font-size: 16px" onclick="toBottom()"><u>&gt;</u></a>

    <!-- 112, 136, 160, 184, 208 -->
    <a class="link standart" style="top: 112px; font-size: 16px" onclick="setTheme('standart')">S</a>
    <a class="link black" style="top: 136px; font-size: 16px" onclick="setTheme('black')">B</a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="animation.js"></script>
  </body>
  </html>
  END;
?>
