<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("./functions/dbfunctions.php");
$dbh = db_connect();

//前後にある半角全角スペースを削除する関数
function spaceTrim ($str) {
	// 行頭
	$str = preg_replace('/^[ 　]+/u', '', $str);
	// 末尾
	$str = preg_replace('/[ 　]+$/u', '', $str);
	return $str;
}

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: index.php");
	exit();
}

//POSTされたデータを各変数に入れる
$score = !empty($_POST['score']) ? $_POST['score'] : NULL;
$review_id = !empty($_POST['review_id']) ? $_POST['review_id'] : NULL;
$message = !empty($_POST['message']) ? $_POST['message'] : NULL;

if(count($errors) === 0){
	//データベースに登録する
	try{
		if (isset($_POST['modify'])){
	    	//score,messageを更新する
			$stm = db_prepare($dbh,'UPDATE reviews set score = :score, message = :message ,updated_at = now() where id = :rid');
			db_execute($stm,array($score, $message, $review_id));
		}else{
			//flagに0を代入し削除扱いとする
			$stm = db_prepare($dbh,'UPDATE reviews set flag = 0 ,updated_at = now() where id = :rid');
			db_execute($stm,array($review_id));
		}
		//データベース接続切断
		$dbh = NULL;

	}catch (PDOException $e){
		throw $e;
		print('Error:'.$e->getMessage());
		die();

		//データベース接続切断
		$dbh = NULL;

		print('Error:'.$e->getMessage());
	}
}else{
	//データベース接続切断
	$dbh = NULL;
}

header("Location: mypage.php");
?>