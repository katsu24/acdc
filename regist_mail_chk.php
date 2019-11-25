<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//CSRF対策のトークン判定
if ($_POST['token'] != $_SESSION['token']){
	echo "不正アクセスの可能性あり";
	exit();
}

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//DB処理関数の読み込み
require("functions/dbfunctions.php");

//データベース接続
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: regist_mail_form.php");
	exit();
}else{
	//POSTされたデータを変数に入れる
	$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;

	//メール入力判定
	if ($mail == ''){
		$errors['mail'] = "メールが入力されていません。";
	}else{
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
			$errors['mail_check'] = "メールアドレスの形式が正しくありません。";
		}

		//ここで本登録用のmemberテーブルにすでに登録されているmailかどうかをチェックする。
		$stm = db_prepare($dbh,'SELECT id FROM `members` WHERE mailaddress=:mail');
        db_execute($stm,array($mail));
        $result = db_fetch($stm);
        if($result!=null){
            $errors['member_check'] = "このメールアドレスはすでに利用されております。";
        }
	}
}

if (count($errors) === 0){

	$urltoken = hash('sha256',uniqid(rand(),1));
	$url = "./regist_form.php"."?urltoken=".$urltoken;

	//ここでデータベースに登録する
	try{
        $stm = db_prepare($dbh,'INSERT INTO pre_member (urltoken,mailaddress,date)  VALUES (:urltoken,:mail,now())');
        db_execute($stm,array($urltoken,$mail));

		//データベース接続切断
		$dbh = null;

	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}

	//メールの宛先
	$mailTo = $mail;

	//Return-Pathに指定するメールアドレス
	$returnMail = 'mailtest@paradero.xyz';

	$name = "ADCDAdmin";
	$mail = 'mailtest@paradero.xyz';
	$subject = "【ACDC】会員登録用URLのお知らせ";

$body = <<< EOM
24時間以内に下記のURLからご登録下さい。
{$url}
EOM;

	mb_language('ja');
	mb_internal_encoding('UTF-8');

	//Fromヘッダーを作成
	$header = 'From: ' . mb_encode_mimeheader($name). ' <' . $mail. '>';

	if (mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail)) {

	 	//セッション変数を全て解除
		$_SESSION = array();

		//クッキーの削除
		if (isset($_COOKIE["PHPSESSID"])) {
			setcookie("PHPSESSID", '', time() - 1800, '/');
		}

 		//セッションを破棄する
        session_destroy();

    $message = "メールをお送りしました。24時間以内にメールに記載されたURLからご登録下さい。";

	} else {

		//メールアドレスをデータベースから削除する
		try{
        $stm = db_prepare($dbh,'DELETE FROM pre_member WHERE mailaddress=:mail');
        db_execute($stm,array($urltoken,$mail));

		//データベース接続切断
		$dbh = null;

		}catch (PDOException $e){
			print('Error:'.$e->getMessage());
			die();
		}

		$errors['mail_error'] = "メールの送信に失敗しました。";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>メール確認画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<h1 class="col-xs-6 col-xs-offset-3">メール確認画面</h1>

<?php if (count($errors) === 0): ?>
<div class="col-xs-6 col-xs-offset-3 well">
	<p><?=$message?></p>

	<p>会員登録用URLが記載されたメールが届きます。</p>

	<?php elseif(count($errors) > 0): ?>

	<?php
		foreach($errors as $value){
			echo "<p>".$value."</p>";
		}
	?>

	<input type="button" value="戻る" onClick="history.back()" class="btn btn-default">

	<?php endif; ?>
</div>
<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>
</html>