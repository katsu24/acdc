<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
if ($_POST['token'] != $_SESSION['token']){
	echo "不正アクセスの可能性あり";
	exit();
}

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("./functions/dbfunctions.php");
$dbh = db_connect();

//エラーメッセージの初期化
$errors = array();

if(empty($_POST)) {
	header("Location: regist_mail_form.php");
	exit();
}

$mail = $_SESSION['mail'];
$name = $_SESSION['name'];

//パスワードのハッシュ化
$password_hash =  crypt($_SESSION['password'], PASSWORD_DEFAULT);

//ここでデータベースに登録する
//トランザクション開始
db_trans($dbh);
try{
    //memberテーブルに本登録する
    $stm = db_prepare($dbh,'INSERT INTO members (name,mailaddress,password,created_at,updated_at) 
                        VALUES (:name,:mail,:password_hash,now(),now())');
    db_execute($stm,array($name,$mail,$password_hash));

    //pre_memberのflagを1にする
    $stm = db_prepare($dbh,'UPDATE pre_member SET flag=1 WHERE mailaddress=(:mail)');
	db_execute($stm,array($mail));

	// トランザクション完了（コミット）
	db_commit($dbh);

	//データベース接続切断
	$dbh = null;

	//セッション変数を全て解除
	$_SESSION = array();

	//セッションクッキーの削除・sessionidとの関係を探れ。つまりはじめのsesssionidを名前でやる
	if (isset($_COOKIE["PHPSESSID"])) {
			setcookie("PHPSESSID", '', time() - 1800, '/');
	}

 	//セッションを破棄する
	session_destroy();


	 //登録完了のメールを送信
    //メールの宛先
	$mailTo = $mail;

	//Return-Pathに指定するメールアドレス
	$returnMail = 'mailtest@paradero.xyz';

	$mailname = "ADCDAdmin";
	$subject = "【ACDC】会員登録ありがとうございました";

$body = <<< EOM
以下の内容で会員登録が完了しました。
メールアドレス：{$mail}
お名前：{$name}

以下のアドレスからログインしてください
https://xxxxxx/acdc/login_form.php
EOM;

	mb_language('ja');
	mb_internal_encoding('UTF-8');

	//Fromヘッダーを作成
	$header = 'From: ' . mb_encode_mimeheader($mailname). ' <' . $returnMail . '>';

	if (mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail)) {
		//
	} else {
		$errors['mail_error'] = "メールの送信に失敗しました。";
	}


}catch (PDOException $e){
	//トランザクション取り消し（ロールバック）
	db_rollback($dbh);
	throw $e;
	$errors['error'] = "もう一度やりなおして下さい。";
	print('Error:'.$e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
<title>会員登録完了画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<?php if (count($errors) === 0): ?>

<h1>会員登録完了画面</h1>

<p>登録完了いたしました。ログイン画面からログインしてください</p>
<p><a href="login_form.php">ログイン画面</a></p>

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