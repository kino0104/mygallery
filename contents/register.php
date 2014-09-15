<?php
require_once('config.php');
include('connection.php');

session_start();

// instagramユーザ名でファイル名を生成
$template = "http://localhost/api/template.php";

$filename = $_SESSION['user']['username'].'.html';
$contents = file_get_contents($template);

file_put_contents($filename, $contents);
header('Location: '.$filename);
