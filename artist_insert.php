<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("./functions/dbfunctions.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: artist_form.php");
	exit();
}

$artist_name = $_POST['artist_name'];
$index_name = $_POST['index_name'];


//データベースに登録する
try{
    //artistテーブルに登録する
    $stm = db_prepare($dbh,'INSERT INTO artist (artist_name, index_name, created_at, updated_at) 
                        VALUES (:artistname, :index_name, now(), now())');
    db_execute($stm,array($artist_name, $index_name));

	//データベース接続切断
	$dbh = null;

}catch (PDOException $e){
	throw $e;
	$errors['error'] = "もう一度やりなおして下さい。";

	//データベース接続切断
	$dbh = null;

	print('Error:'.$e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
<title>アーティスト登録完了画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<?php if (count($errors) === 0): ?>

<h1>アーティスト登録完了</h1>

<p>アーティスト登録完了いたしました。</p>
<p><a href="artist_form.php">アーティスト登録へ</a></p>
<p><a href="album_form.php">アルバム登録へ</a></p>

<?php elseif(count($errors) > 0): ?>

<input type="button" value="戻る" onClick="history.back()" class="btn btn-default">

<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>

<?php endif; ?>

<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>
</html>