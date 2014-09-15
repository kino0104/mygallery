<?php
require_once('config.php');
include('connection.php');

session_start();

$_SESSION = array();


if(isset($_COOKIE[session_name()])){
	setcookie(session_name(), '', time()-864000, '/api/');
}

session_destroy();
header('Location: '.SITE_URL.'login.php');
