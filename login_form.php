<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

?>

<!DOCTYPE html>
<html>
<head>
<title>ログイン画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<h1 class="col-xs-6 col-xs-offset-3">ログイン画面</h1>
<div class="col-xs-6 col-xs-offset-3 well">
    <form action="login_chk.php" method="post">
        <div class="form_group">
            <label for=input_mail>メールアドレス：</label>
            <input type="text" name="mail" size="50" class="form_control" id="input_mail">
        </div>
        <div class="form-group">
            <label for=input_password>パスワード：</label>
            <input type="text" name="password" size="50" class="form-cotrol" id="input_password">
        </div>

        <input type="hidden" name="token" value="<?=$token?>">
        <input type="submit" value="ログインする" class="btn btn-default">
    </form>
</div>
<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>
</html>