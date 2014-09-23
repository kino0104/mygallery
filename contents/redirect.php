<?php

require_once('config.php');
include('connection.php');

session_start();

if(empty($_GET['code'])){
	//認証前の準備
	
	$params = array(
		'client_id' => CLIENT_ID,
		'redirect_uri' => SITE_URL.'redirect.php', 
		'scope' => 'basic',
		'response_type' => 'code' 
	);
	$url = 'https://api.instagram.com/oauth/authorize/?'.http_build_query($params);

	//instagramへ飛ばす
	//instagramでcodeをgetしてくる
	header('Location: '.$url);
	exit;

}else{
	//認証後の処理
	//user情報の取得
	$params = array(
		'client_id'=> CLIENT_ID,
		'client_secret'=> CLIENT_SECRET,
		'code'=> $_GET['code'],
		'redirect_uri'=> SITE_URL.'redirect.php',
		'grant_type'=> 'authorization_code'
	);
	$url = "https://api.instagram.com/oauth/access_token";
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
	
	$res = curl_exec($curl);
	curl_close($curl);
	$json = json_decode($res);

	//user情報の格納

	$dbh = get_connection();
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	$stmt = $dbh->prepare("select * from users where id=:user_id limit 1");
	$stmt->execute(array(":user_id"=>$json->user->id));
	$user = $stmt->fetch();

	if(empty($user)){
		$stmt = $dbh->prepare("insert into users
		(id, username, access_token, created_at, updated_at) values
		(:user_id, :user_name, :access_token, now(), now())");
		
		$params = array(
			":user_id"=>$json->user->id,
			":user_name"=>$json->user->username,
			":access_token"=>$json->access_token
		);
		$stmt->execute($params);
		$id = $json->user->id;
		//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//挿入したデータをひっぱってくる
		$stmt = $dbh->prepare("select * from users where id=:id limit 1");
		$stmt->execute(array(":id"=>$id));
		$user = $stmt->fetch();
		$access_token = $json->access_token;
		//var_dump($access_token);

		//photosテーブルに写真を格納
		$url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=".$access_token."&count=-1";
		$json = file_get_contents($url);
		$json = json_decode($json);
		//var_dump($json);

		$stmt = $dbh->prepare("replace into photos (id, user_id, username, high_image_url, high_image_width, high_image_height,
		low_image_url, low_image_width, low_image_height, created_at, updated_at) values
		(:id, :user_id, :username, :high_image_url, :high_image_width, :high_image_height,
		:low_image_url, :low_image_width, :low_image_height, now(), now())");

		foreach($json->data as $data){
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":user_id", $user_id);
		$stmt->bindParam(":username", $username);
		$stmt->bindParam(":high_image_url", $high_image_url);
		$stmt->bindParam(":high_image_width", $high_image_width);
		$stmt->bindParam(":high_image_height", $high_image_height);
		$stmt->bindParam(":low_image_url", $low_image_url);
		$stmt->bindParam(":low_image_width", $low_image_width);
		$stmt->bindParam(":low_image_height", $low_image_height);

		$id = $data->id;
		//var_dump($id);
		$user_id = $data->user->id;
		$username = $data->user->username;
		//var_dump($username);
		//exit;
		$high_image_url = $data->images->standard_resolution->url;
		//var_dump($high_image_url);
		$high_image_width = $data->images->standard_resolution->width;
		$high_image_height = $data->images->standard_resolution->height;
		$low_image_url = $data->images->low_resolution->url;
		$low_image_width = $data->images->low_resolution->width;
		$low_image_height = $data->images->low_resolution->height;
		$test = $stmt->execute();
		//var_dump($dbh->errorInfo());
		}
	}

	//ログイン処理
	if(!empty($user)){
		session_regenerate_id(true);
		$_SESSION['user'] = $user;
	}

	//var_dump($test);
	//var_dump($dbh->errorInfo());
	//exit;
		
	header('Location: '.SITE_URL.'gallery.php');
}

