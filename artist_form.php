<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

?>

<!DOCTYPE html>
<html>
<head>
<title>アーティスト登録</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<h1 class="col-xs-6 col-xs-offset-3">アーティスト登録</h1>
<div class="col-xs-6 col-xs-offset-3 well">
    <form action="artist_insert.php" method="post">
        <div class="form-group">
            <label for=input_artist_name>アーティスト名</label>
            <input type="text" name="artist_name" class="form-control" id="input_artist_name">
        </div>
        <div class="form-group">
            <label for=input_artist_name>インデックス用頭文字</label>
            <input type="text" name="index_name" class="form-control" id="input_index_name">
        </div>
        <input type="submit" value="登録" class="btn btn-default">
    </form>
</div>
<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>
</html>