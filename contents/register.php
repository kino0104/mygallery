<?php
require_once('config.php');
include('connection.php');

session_start();
$username = $_SESSION['user']['username'];
// instagramユーザ名でファイル名を生成
$template = "http://instass.xyz/template.php";

$filename = $_SESSION['user']['username'].'.html';
$contents = file_get_contents($template);
$contents = str_replace("TITLE", $username."'s Gallery", $contents);
$contents = str_replace("HEADER1", $username."'s Gallery", $contents);
file_put_contents($filename, $contents);
header('Location: '.$filename);
