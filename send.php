<?php
$str = isset($_POST['str']) ? $_POST['str'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

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
} catch (Exception $e) {
  exit();
}

if ($str != '') {
  $str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str);

  // Custom tags, colors, standard tags
  $str = preg_replace('/\[(rainbow|magic|blink|gold|bronze|silver|jump|shake)]((.|\n)+?)\[\/\]/', '<span class="${1}-animated">${2}</span>', $str);
  $str = preg_replace('/\[#(([0-9a-fA-F]{3}){1,2})\]((.|\n)+?)\[\/\]/', '<span style="color: #${1}">${3}</span>', $str);
  $str = preg_replace('/\[([subi])]((.|\n)+?)\[\/\1\]/', '<${1}>${2}</${1}>', $str);

  // Non empty or image
  if (trim(strip_tags($str)) != '') {
    $str = preg_replace('/\[img\]([^"]+?)\[\/img\]/', '<img src="${1}"></img loading="lazy">', $str);

    $sql = $link->prepare('INSERT INTO comments(comment, birthtime) VALUES (:comment, NOW())');
    $sql->execute(array('comment' => $str));
  }
}

// Load new comments if exists
$sql = $link->prepare('SELECT comment, birthtime, id FROM comments WHERE id > :id ORDER BY id');
$sql->execute(array('id' => $id));
$types = array();

while ($row = $sql->fetch()) {
  array_push($types, array('comments' => $row['comment'], 'birthtime' => $row['birthtime'], 'id' => $row['id']));
}

echo json_encode($types, JSON_UNESCAPED_UNICODE);
?>
