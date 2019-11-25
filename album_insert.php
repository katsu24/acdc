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
	header("Location: album_form.php");
	exit();
}

//POSTされたデータを各変数に入れる
$title = !empty($_POST['title']) ? spaceTrim($_POST['title']) : NULL;
$artist_id = !empty($_POST['artist_id']) ? $_POST['artist_id'] : NULL;
$year = !empty($_POST['year']) ? spaceTrim($_POST['year']) : NULL;
$jacket = !empty($_POST['jacket']) ? spaceTrim($_POST['jacket']) : NULL;
$genre = !empty($_POST['genre']) ? spaceTrim($_POST['genre']) : NULL;
$disc1_1 = !empty($_POST['disc1_1']) ? $_POST['disc1_1'] : NULL;
$disc1_2 = !empty($_POST['disc1_2']) ? $_POST['disc1_2'] : NULL;
$disc1_3 = !empty($_POST['disc1_3']) ? $_POST['disc1_3'] : NULL;
$disc1_4 = !empty($_POST['disc1_4']) ? $_POST['disc1_4'] : NULL;
$disc1_5 = !empty($_POST['disc1_5']) ? $_POST['disc1_5'] : NULL;
$disc1_6 = !empty($_POST['disc1_6']) ? $_POST['disc1_6'] : NULL;
$disc1_7 = !empty($_POST['disc1_7']) ? $_POST['disc1_7'] : NULL;
$disc1_8 = !empty($_POST['disc1_8']) ? $_POST['disc1_8'] : NULL;
$disc1_9 = !empty($_POST['disc1_9']) ? $_POST['disc1_9'] : NULL;
$disc1_10 = !empty($_POST['disc1_10']) ? $_POST['disc1_10'] : NULL;
$disc1_11 = !empty($_POST['disc1_11']) ? $_POST['disc1_11'] : NULL;
$disc1_12 = !empty($_POST['disc1_12']) ? $_POST['disc1_12'] : NULL;
$disc1_13 = !empty($_POST['disc1_13']) ? $_POST['disc1_13'] : NULL;
$disc1_14 = !empty($_POST['disc1_14']) ? $_POST['disc1_14'] : NULL;
$disc1_15 = !empty($_POST['disc1_15']) ? $_POST['disc1_15'] : NULL;
$disc1_16 = !empty($_POST['disc1_16']) ? $_POST['disc1_16'] : NULL;
$disc1_17 = !empty($_POST['disc1_17']) ? $_POST['disc1_17'] : NULL;
$disc1_18 = !empty($_POST['disc1_18']) ? $_POST['disc1_18'] : NULL;
$disc1_19 = !empty($_POST['disc1_19']) ? $_POST['disc1_19'] : NULL;
$disc1_20 = !empty($_POST['disc1_20']) ? $_POST['disc1_20'] : NULL;
$disc2_1 = !empty($_POST['disc2_1']) ? $_POST['disc2_1'] : NULL;
$disc2_2 = !empty($_POST['disc2_2']) ? $_POST['disc2_2'] : NULL;
$disc2_3 = !empty($_POST['disc2_3']) ? $_POST['disc2_3'] : NULL;
$disc2_4 = !empty($_POST['disc2_4']) ? $_POST['disc2_4'] : NULL;
$disc2_5 = !empty($_POST['disc2_5']) ? $_POST['disc2_5'] : NULL;
$disc2_6 = !empty($_POST['disc2_6']) ? $_POST['disc2_6'] : NULL;
$disc2_7 = !empty($_POST['disc2_7']) ? $_POST['disc2_7'] : NULL;
$disc2_8 = !empty($_POST['disc2_8']) ? $_POST['disc2_8'] : NULL;
$disc2_9 = !empty($_POST['disc2_9']) ? $_POST['disc2_9'] : NULL;
$disc2_10 = !empty($_POST['disc2_10']) ? $_POST['disc2_10'] : NULL;
$disc2_11 = !empty($_POST['disc2_11']) ? $_POST['disc2_11'] : NULL;
$disc2_12 = !empty($_POST['disc2_12']) ? $_POST['disc2_12'] : NULL;
$disc2_13 = !empty($_POST['disc2_13']) ? $_POST['disc2_13'] : NULL;
$disc2_14 = !empty($_POST['disc2_14']) ? $_POST['disc2_14'] : NULL;
$disc2_15 = !empty($_POST['disc2_15']) ? $_POST['disc2_15'] : NULL;
$disc2_16 = !empty($_POST['disc2_16']) ? $_POST['disc2_16'] : NULL;
$disc2_17 = !empty($_POST['disc2_17']) ? $_POST['disc2_17'] : NULL;
$disc2_18 = !empty($_POST['disc2_18']) ? $_POST['disc2_18'] : NULL;
$disc2_19 = !empty($_POST['disc2_19']) ? $_POST['disc2_19'] : NULL;
$disc2_20 = !empty($_POST['disc2_20']) ? $_POST['disc2_20'] : NULL;
$disc3_1 = !empty($_POST['disc3_1']) ? $_POST['disc3_1'] : NULL;
$disc3_2 = !empty($_POST['disc3_2']) ? $_POST['disc3_2'] : NULL;
$disc3_3 = !empty($_POST['disc3_3']) ? $_POST['disc3_3'] : NULL;
$disc3_4 = !empty($_POST['disc3_4']) ? $_POST['disc3_4'] : NULL;
$disc3_5 = !empty($_POST['disc3_5']) ? $_POST['disc3_5'] : NULL;
$disc3_6 = !empty($_POST['disc3_6']) ? $_POST['disc3_6'] : NULL;
$disc3_7 = !empty($_POST['disc3_7']) ? $_POST['disc3_7'] : NULL;
$disc3_8 = !empty($_POST['disc3_8']) ? $_POST['disc3_8'] : NULL;
$disc3_9 = !empty($_POST['disc3_9']) ? $_POST['disc3_9'] : NULL;
$disc3_10 = !empty($_POST['disc3_10']) ? $_POST['disc3_10'] : NULL;
$disc3_11 = !empty($_POST['disc3_11']) ? $_POST['disc3_11'] : NULL;
$disc3_12 = !empty($_POST['disc3_12']) ? $_POST['disc3_12'] : NULL;
$disc3_13 = !empty($_POST['disc3_13']) ? $_POST['disc3_13'] : NULL;
$disc3_14 = !empty($_POST['disc3_14']) ? $_POST['disc3_14'] : NULL;
$disc3_15 = !empty($_POST['disc3_15']) ? $_POST['disc3_15'] : NULL;
$disc3_16 = !empty($_POST['disc3_16']) ? $_POST['disc3_16'] : NULL;
$disc3_17 = !empty($_POST['disc3_17']) ? $_POST['disc3_17'] : NULL;
$disc3_18 = !empty($_POST['disc3_18']) ? $_POST['disc3_18'] : NULL;
$disc3_19 = !empty($_POST['disc3_19']) ? $_POST['disc3_19'] : NULL;
$disc3_20 = !empty($_POST['disc3_20']) ? $_POST['disc3_20'] : NULL;
$disc4_1 = !empty($_POST['disc4_1']) ? $_POST['disc4_1'] : NULL;
$disc4_2 = !empty($_POST['disc4_2']) ? $_POST['disc4_2'] : NULL;
$disc4_3 = !empty($_POST['disc4_3']) ? $_POST['disc4_3'] : NULL;
$disc4_4 = !empty($_POST['disc4_4']) ? $_POST['disc4_4'] : NULL;
$disc4_5 = !empty($_POST['disc4_5']) ? $_POST['disc4_5'] : NULL;
$disc4_6 = !empty($_POST['disc4_6']) ? $_POST['disc4_6'] : NULL;
$disc4_7 = !empty($_POST['disc4_7']) ? $_POST['disc4_7'] : NULL;
$disc4_8 = !empty($_POST['disc4_8']) ? $_POST['disc4_8'] : NULL;
$disc4_9 = !empty($_POST['disc4_9']) ? $_POST['disc4_9'] : NULL;
$disc4_10 = !empty($_POST['disc4_10']) ? $_POST['disc4_10'] : NULL;
$disc4_11 = !empty($_POST['disc4_11']) ? $_POST['disc4_11'] : NULL;
$disc4_12 = !empty($_POST['disc4_12']) ? $_POST['disc4_12'] : NULL;
$disc4_13 = !empty($_POST['disc4_13']) ? $_POST['disc4_13'] : NULL;
$disc4_14 = !empty($_POST['disc4_14']) ? $_POST['disc4_14'] : NULL;
$disc4_15 = !empty($_POST['disc4_15']) ? $_POST['disc4_15'] : NULL;
$disc4_16 = !empty($_POST['disc4_16']) ? $_POST['disc4_16'] : NULL;
$disc4_17 = !empty($_POST['disc4_17']) ? $_POST['disc4_17'] : NULL;
$disc4_18 = !empty($_POST['disc4_18']) ? $_POST['disc4_18'] : NULL;
$disc4_19 = !empty($_POST['disc4_19']) ? $_POST['disc4_19'] : NULL;
$disc4_20 = !empty($_POST['disc4_20']) ? $_POST['disc4_20'] : NULL;

//タイトル入力判定
if ($title == ''):
	$errors['title'] = "タイトルが入力されていません。";
endif;

if(count($errors) === 0){
	//データベースに登録する
	try{
	    //albumsテーブルに登録する
	    $stm = db_prepare($dbh,'INSERT INTO albums (title, artist_id, year, jacket, genre, disc1_1, disc1_2, disc1_3, 
							disc1_4, disc1_5, disc1_6, disc1_7, disc1_8, disc1_9, disc1_10, disc1_11, disc1_12,
							disc1_13, disc1_14, disc1_15, disc1_16, disc1_17, disc1_18, disc1_19, disc1_20,
							disc2_1, disc2_2, disc2_3, disc2_4, disc2_5, disc2_6, disc2_7, disc2_8, disc2_9, 
							disc2_10, disc2_11, disc2_12, disc2_13, disc2_14, disc2_15, disc2_16, disc2_17, 
							disc2_18, disc2_19, disc2_20, disc3_1, disc3_2, disc3_3, disc3_4, disc3_5, disc3_6, 
							disc3_7, disc3_8, disc3_9, disc3_10, disc3_11, disc3_12, disc3_13, disc3_14, disc3_15, 
							disc3_16, disc3_17, disc3_18, disc3_19, disc3_20, disc4_1, disc4_2, disc4_3, disc4_4, 
							disc4_5, disc4_6, disc4_7, disc4_8, disc4_9, disc4_10, disc4_11, disc4_12, disc4_13, 
							disc4_14, disc4_15, disc4_16, disc4_17, disc4_18, disc4_19, disc4_20, 
							created_at,updated_at) 
	                        VALUES (:title, :artist_id, :yaer, :jacket, :genre, :disc1_1, :disc1_2, :disc1_3, 
							:disc1_4, :disc1_5, :disc1_6, :disc1_7, :disc1_8, :disc1_9, :disc1_10, :disc1_11,
							:disc1_12, :disc1_13, :disc1_14, :disc1_15, :disc1_16, :disc1_17, :disc1_18, :disc1_19, 
							:disc1_20, :disc2_1, :disc2_2, :disc2_3, :disc2_4, :disc2_5, :disc2_6, :disc2_7, :disc2_8, 
							:disc2_9, :disc2_10, :disc2_11, :disc2_12, :disc2_13, :disc2_14, :disc2_15, :disc2_16, 
							:disc2_17, :disc2_18, :disc2_19, :disc2_20, :disc3_1, :disc3_2, :disc3_3, :disc3_4, :disc3_5, 
							:disc3_6, :disc3_7, :disc3_8, :disc3_9, :disc3_10, :disc3_11, :disc3_12, :disc3_13, 
							:disc3_14, :disc3_15, :disc3_16, :disc3_17, :disc3_18, :disc3_19, :disc3_20, :disc4_1, 
							:disc4_2, :disc4_3, :disc4_4, :disc4_5, :disc4_6, :disc4_7, :disc4_8, :disc4_9, :disc4_10, 
							:disc4_11, :disc4_12, :disc4_13, :disc4_14, :disc4_15, :disc4_16, :disc4_17, :disc4_18, 
							:disc4_19, :disc4_20, now(),now())');
		db_execute($stm,array($title, $artist_id, $year, $jacket, $genre, $disc1_1, $disc1_2, $disc1_3, $disc1_4,
							$disc1_5, $disc1_6, $disc1_7, $disc1_8, $disc1_9, $disc1_10, $disc1_11, $disc1_12, 
							$disc1_13, $disc1_14, $disc1_15, $disc1_16, $disc1_17, $disc1_18, $disc1_19, $disc1_20, 
							$disc2_1, $disc2_2, $disc2_3, $disc2_4, $disc2_5, $disc2_6, $disc2_7, $disc2_8, $disc2_9, 
							$disc2_10, $disc2_11, $disc2_12, $disc2_13, $disc2_14, $disc2_15, $disc2_16, $disc2_17, 
							$disc2_18, $disc2_19, $disc2_20, $disc3_1, $disc3_2, $disc3_3, $disc3_4, $disc3_5, $disc3_6, 
							$disc3_7, $disc3_8, $disc3_9, $disc3_10, $disc3_11, $disc3_12, $disc3_13, $disc3_14, $disc3_15, 
							$disc3_16, $disc3_17, $disc3_18, $disc3_19, $disc3_20, $disc4_1, $disc4_2, $disc4_3, $disc4_4, 
							$disc4_5, $disc4_6, $disc4_7, $disc4_8, $disc4_9, $disc4_10, $disc4_11, $disc4_12, $disc4_13, 
							$disc4_14, $disc4_15, $disc4_16, $disc4_17, $disc4_18, $disc4_19, $disc4_20));

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

?>

<!DOCTYPE html>
<html>
<head>
<title>アルバム登録完了画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<?php if (count($errors) === 0): ?>

<h1>アルバム登録完了</h1>

<p>アルバム登録完了いたしました。</p>
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