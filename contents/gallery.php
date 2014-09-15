<?php

require_once('config.php');
include('connection.php');

session_start();

if(empty($_SESSION['user'])){
	header('Location: '.SITE_URL.'login.php');
	exit;
}
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
		<meta charset="utf-8">
        <title>Kino Photography</title>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

        <script src="js/myscript.js"></script>
        <!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.6.0/build/cssreset/cssreset-min.css" />
		<link rel="stylesheet" media="screen" href="css/mycss.css" />
	</head>
    <body>
    <div id="container">
    <div id="header">
    	<div id="title">
    		<h1>Kyousuke Kinoshita</h1>
    		
    	</div>
    	<div id="menu">
    		<ul>
    		<li><a href="index.html">Top</a></li>
    		<li><a href="about.html">About</a></li>
    		<li><a href="gallery.php">Gallery</a></li>
    		<li><a href="contact.html">Contact</a></li>
    		</ul>
    	</div>
    </div>

    <div id="main">
    <!-- 写真並び替え処理へ -->
    <form class="gform" action="sort.php" method="post">
		<input type="submit" id="sort" name="photos" value="並び替え" />
	</form>

	<!-- galleryページ生成処理へ -->
	<form class="gform" action="resister.php" method="get">
		<input type="submit" id="submit" value="登録" />
	</form>
	
	<!-- 写真を再取得 -->
	<form class="gform" action="reset.php" method="get">
		<input type="submit" value="リセット" />
	</form>
	
	<div id="logout">
	<a href="logout.php">[ログアウト]</a>
	</div>
	<div id="makegallery"></div>

	</div>

    <div id="footer">Copyright 2014 Kyousuke Kinoshita</div>


    </div><!-- container -->
    </body>
</html>
