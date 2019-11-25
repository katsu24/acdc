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
	header("Location: login_form.php");
	exit();
}else{
	//POSTされたデータを各変数に入れる
	$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
	$password = isset($_POST['password']) ? $_POST['password'] : NULL;

	//前後にある半角全角スペースを削除
	$mail = spaceTrim($mail);
	$password = spaceTrim($password);

	//アカウント入力判定
	if ($mail == ''):
		$errors['mail'] = "メールアドレスが入力されていません。";
	endif;

	//パスワード入力判定
	if ($password == ''):
		$errors['password'] = "パスワードが入力されていません。";
	elseif(!preg_match('/^[0-9a-zA-Z]{5,30}$/', $_POST["password"])):
		$errors['password_length'] = "パスワードは半角英数字の5文字以上30文字以下で入力して下さい。";
	else:
		$password_hide = str_repeat('*', strlen($password));
	endif;

}

//エラーが無ければ実行する
if(count($errors) === 0){
	try{
		//アカウントで検索
		$stm = db_prepare($dbh,'SELECT * FROM members WHERE mailaddress=(:mail) AND flag =1');
		db_execute($stm,array($mail));

		//アカウントが一致
		if($row = $stm->fetch()){

			$password_hash = $row['password'];

			//パスワードが一致
			//f (password_verify($password, $password_hash)) {
			if ($password = crypt($password_hash, PASSWORD_DEFAULT)) {

				//セッションハイジャック対策
				session_regenerate_id(true);

				$_SESSION['name'] = $row['name'];
				$_SESSION['admin'] = $row['admin'];
				$_SESSION['member_id'] = $row['id'];

				header("Location: index.php");
				exit();
			}else{
				$errors['password'] = "アカウント及びパスワードが一致しません。";
			}
		}else{
			$errors['account'] = "アカウント及びパスワードが一致しません。";
		}

		//データベース接続切断
		$dbh = null;

	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>ログイン確認画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>

<h1 class="col-xs-6 col-xs-offset-3">ログイン確認画面</h1>

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