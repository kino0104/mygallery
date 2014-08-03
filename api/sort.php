<?php
  header('Content-Type: text/javascript; charset=utf-8');
  include('connection.php');

  $sql = 'SELECT * FROM photos ORDER BY sort;';
  $reuslts = array();
  $dbh = get_connection();

  $user_id = get_user_id_by_sid($dbh, $_POST['sid']);

  # 最初は全件後回しになるように設定する
  $stmt = $dbh->prepare('UPDATE photos SET sort = 9999 WHERE user_id = ?;');
  $stmt->execute(array($user_id));

  $i = 0;
  foreach (explode(',', $_POST['photos']) as $photo_id) {
    $stmt = $dbh->prepare('UPDATE photos SET sort = ? WHERE id = ? AND user_id = ?;');
    $stmt->execute(array(++$i, $photo_id, $user_id));
  }

  # リソースの解放
  $dbh = null;

  echo(json_encode(array('status' => 'OK')));

  function get_user_id_by_sid($dbh, $sid) {
    $sql = 'SELECT id FROM users WHERE sid = ? AND session_expires_at > CURRENT_TIMESTAMP LIMIT 1;';
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array($sid));
    return($stmt->fetch()['id']);
  }
?>
