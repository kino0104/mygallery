<?php
  header('Content-Type: text/javascript; charset=utf-8');
  include('connection.php');

  $sql = 'SELECT * FROM photos ORDER BY sort;';
  $reuslts = array();
  $dbh = get_connection();

  # ログインユーザのセッションを格納
  $user_id = $_SESSION['user']['id'];

  # 最初は全件後回しになるように設定する
  $stmt = $dbh->prepare('UPDATE photos SET sort = 9999 WHERE user_id = ?;');
  $stmt->execute(array($user_id));

  $i = 0;
  foreach (explode(',', $_POST['photos']) as $photo_id) {
    $stmt = $dbh->prepare('UPDATE photos SET sort = ? WHERE id = ? AND user_id = ?;');
    $stmt->execute(array(++$i, $photo_id, $user_id));
  }

  # sort=9999データの削除
  $sort = 9999;
  $stmt = $dbh->prepare('delete from photos where sort = ?;');
  $stmt->execute(array($sort));

  # リソースの解放
  $dbh = null;

  header('Location:'.SITE_URL.'gallery.php');

?>
