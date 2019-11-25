<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("./functions/dbfunctions.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

if(empty($_GET)) {
	header("Location: regist_mail_form.php");
	exit();
}else{
	//GETデータを変数に入れる
	$urltoken = isset($_GET['urltoken']) ? $_GET['urltoken'] : NULL;
	//メール入力判定
	if ($urltoken == ''){
		$errors['urltoken'] = "もう一度登録をやりなおして下さい。";
	}else{
		try{
            //flagが0の未登録者・仮登録日から24時間以内
            $stm = db_prepare($dbh,'SELECT mailaddress FROM pre_member WHERE urltoken=(:urltoken) AND flag =0 AND date > now() - interval 24 hour');
            db_execute($stm,array($urltoken));

			//レコード件数取得
			$row_count = $stm->rowCount();

			//24時間以内に仮登録され、本登録されていないトークンの場合
			if( $row_count ==1){
				$mail_array = $stm->fetch();
				$mail = $mail_array['mailaddress'];
				$_SESSION['mail'] = $mail;
			}else{
				$errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が過ぎた等の問題があります。もう一度登録をやりなおして下さい。";
			}

			//データベース接続切断
			$dbh = null;

		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			die();
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>会員登録画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<h1 class="col-xs-6 col-xs-offset-3">会員登録画面</h1>

<?php if (count($errors) === 0): ?>
<div class="col-xs-6 col-xs-offset-3 well">
	<form action="regist_chk.php" method="post">
	<div class="from-group">
		<label for="dsp_mail">メールアドレス：</label>
		<p id="dsp_mail"><?=htmlspecialchars($mail, ENT_QUOTES, 'UTF-8')?></p>
	</div>
	<div class="from-group">
		<label for="input_name">お名前：</label>
		<input type="text" name="name" id="input_name" class="form_control">
	</div>
	<div class="from-group">
		<label for="input_password">パスワード：</label>
		<input type="text" name="password" id="input_password" class="form_control">
	</div>

	<input type="hidden" name="token" value="<?=$token?>">
	<input type="submit" value="確認する">

	</form>
</div>


<?php elseif(count($errors) > 0): ?>

<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>

<?php endif; ?>

<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>
</html>