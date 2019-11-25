<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//CSRF対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

?>

<!DOCTYPE html>
<html>
<head>
<title>メールアドレス登録画面</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<h1 class="col-xs-6 col-xs-offset-3">メールアドレス登録</h1>
<div class="col-xs-6 col-xs-offset-3 well">
    <form action="regist_mail_chk.php" method="post">
        <div class="form-group">
            <label for="input_mail">メールアドレス：</label>
            <input type="text" name="mail" size="50" class="form-control" id="input_mail">
        </div>
        <input type="hidden" name="token" value="<?=$token?>">
        <input type="submit" value="登録する" class="btn btn-default">
    </form>
</div>
<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>
</html>