<?php
  header('Content-Type: text/javascript; charset=utf-8');
  include('connection.php');

  $sql = 'SELECT * FROM photos ORDER BY sort;';
  $reuslts = array();
  $dbh = get_connection();

  foreach ($dbh->query($sql) as $row) {
    $results[] = array(
      'id' => $row['id'],
      'high_image' => array(
        'url' => $row['high_image_url'],
        'width' => $row['high_image_width'],
        'height' => $row['high_image_height']
      ),
      'low_image' => array(
        'url' => $row['low_image_url'],
        'width' => $row['low_image_width'],
        'height' => $row['low_image_height']
      )
    );
  }

  $dbh = null;

  echo(json_encode(array('status' => 'OK', 'results' => $results)));
?>
