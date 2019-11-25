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
	header("Location: album_detail.php");
	exit();
}else{
	//POSTされたデータを各変数に入れる
	$member = isset($_POST['member']) ? $_POST['member'] : NULL;
	$member_id = isset($_POST['member_id']) ? $_POST['member_id'] : NULL;
	$album_id = isset($_POST['album_id']) ? $_POST['album_id'] : NULL;
	$name = isset($_POST['name']) ? $_POST['name'] : NULL;
	$message = isset($_POST['message']) ? $_POST['message'] : NULL;
	$score = isset($_POST['score']) ? $_POST['score'] : NULL;

	//前後にある半角全角スペースを削除
	$name = spaceTrim($name);

	//名前入力判定
	if ($name == ''):
		$errors['name'] = "お名前が入力されていません。";
	endif;

	//スコア入力判定
	if ($score == ''):
		$errors['score'] = "スコアが入力されていません。";
	endif;

	if(count($errors) === 0){
		try{
			//reviewsテーブルに本登録する
			$stm = db_prepare($dbh,'INSERT INTO reviews (album_id,name,message,score,member,member_id,created_at,updated_at) 
			VALUES (:albumid,:name,:message,:score,:member,:member_id,now(),now())');
			db_execute($stm,array($album_id,$name,$message,$score,$member,$member_id));
			header("Location: album_detail.php?id=" . $album_id);
		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			die();
		}
		//データベース接続切断
		$dbh = null;
		exit();
	}else{
		$dbh = null;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>レビュー登録確認画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>

<h1 class="col-xs-6 col-xs-offset-3">レビュー登録確認画面</h1>

<?php if(count($errors) > 0): ?>
<div class="col-xs-6 col-xs-offset-3 well">
<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>

<input type="button" value="戻る" onClick="history.back()" >

<?php endif; ?>
</div>
</body>
</html>