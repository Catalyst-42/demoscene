<?php
$bad_apple = array(
    "start" => 102096,
    "end" => 108698,
);

try {
  $link = new mysqli(getenv('DEMOSCENE_DATABASE_URL'), getenv('DEMOSCENE_USER'), getenv('DEMOSCENE_PASSWORD'), 'demoscene');
} catch (Exception $e) {
  exit();
}

mysqli_set_charset($link, "utf8");

$sql = "SELECT comments, data, id FROM near WHERE id >= {$bad_apple['start']} and id <= {$bad_apple['end']}";
$result = mysqli_query($link, $sql);

$messages = array();
while ($row = mysqli_fetch_assoc($result)) {
  $messages[] = array(
    'comments' => $row['comments'],
    'data' => $row['data'],
    'id' => $row['id']
  );
}

echo json_encode($messages, JSON_UNESCAPED_UNICODE);
?>
