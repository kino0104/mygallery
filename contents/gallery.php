<?php

require_once('config.php');
include('connection.php');

session_start();

$username = $_SESSION['user']['username'];
if(empty($_SESSION['user'])){
	header('Location: '.SITE_URL.'login.php');
	exit;
}
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
        <title>InstaSS</title>
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
    		<h1>InstaSS</h1> 		
    	</div>
    	<div id="menu">
			<p>Hello, <?php echo h($username); ?>!<br/>
				お気に入り写真をクリックして<br/>
				Instagramにアップした写真からSolo Show（個展）を作成してください！</p>
    	</div>
    </div>

    <div id="main">
    <!-- 写真並び替え処理へ -->
    <div id="form">
    <form class="gform" action="sort.php" method="post">
		<input type="submit" id="sort" name="photos" value="並び替え" />
	</form>

	<!-- galleryページ生成処理へ -->
	<form class="gform" action="register.php" method="get">
		<input type="submit" id="submit" value="登録" />
	</form>
	
	<!-- 写真を再取得 -->
	<form class="gform" action="reset.php" method="get">
		<input type="submit" id="reset" value="リセット" />
	</form>
	</div>
	<div id="logout">
	<a href="logout.php">ログアウト</a>
	</div>
	<div id="makegallery"></div>

	</div>

    <div id="footer">Copyright 2014 instass</div>


    </div><!-- container -->
    </body>
</html>
