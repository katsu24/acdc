<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("./functions/dbfunctions.php");
$dbh = db_connect();

//登録ユーザ数を取得
$stm = db_prepare($dbh,'SELECT count(id) as count FROM members WHERE flag =1');
$stm -> execute();
$entrymembers = db_fetch($stm);

//登録レビュー数を取得
$stm = db_prepare($dbh,'SELECT count(id) as count FROM reviews WHERE flag =1');
$stm -> execute();
$entryreviews = db_fetch($stm);

//登録アーティスト一覧を取得
$stm = db_prepare($dbh,'SELECT id,artist_name,index_name FROM artist WHERE flag =1 order by index_name,artist_name');
$stm -> execute();
$artists = db_fetch($stm);

?>

<!DOCTYPE html>
<html>
<head>
<title>サイト名 -トップページ-</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>

<?php include(dirname(__FILE__).'/layout/header.html'); ?>
<p style="height:15px;"></p>
<div class="col-xs-6 col-xs-offset-6">
    <form action="album_list.php" method="get" class="form-inline">
        <div class="form-group">
            <div>
            <label for="input_title">アルバム名：</label>
            <input type="text" name="title" class="form-control" id="input_title">
            <button type="submit" class="btn btn-default" name="search">検索</button>
            </div>
        </div>
    </form>
    <form action="album_list.php" class="form-inline" method="get">
        <div class="form-group">
            <label for="iinput_artistname">アーティスト名：</label>
            <input type="text" name="artistname" class="form-control" id="input_artistname">
            <button type="submit" class="btn btn-default" name="search">検索</button>
        </div>
    </form>
</div>
<p style="height:5px;"></p>
<h1 class="col-xs-6 col-xs-offset-3"></h1>
<div class="col-xs-6 col-xs-offset-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">登録ユーザ数</div>
            <div class="col-sm-3"><?php echo $entrymembers[0]['count'] ?></div>
            <div class="col-sm-3">登録レビュー数</div>
            <div class="col-sm-3"><?php echo $entryreviews[0]['count'] ?></div>
        </div>
    </div>
</div>
<p style="height:25px;"></p>
<h3 class="col-xs-6 col-xs-offset-3">アーティスト一覧</h3>
<div class="col-xs-6 col-xs-offset-3 well">
<div class="container-fluid">
    <?php
        $indexname = "";
        foreach($artists as $row):
        if ($indexname <> $row['index_name']): ?>
        <div class=col-sm-12>
            <h3><?php echo htmlspecialchars($row['index_name']) ?></h3>
        </div>
        <div class=col-sm-4>
        ・<a href="album_list.php?aid=<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['artist_name']) ?></a>
        </div>
    <?php
        $indexname = $row['index_name'];
        else:
    ?>
        <div class=col-sm-4>
        ・<a href="album_list.php?aid=<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['artist_name']) ?></a>
        </div>
    <?php endif; ?>
    <?php endforeach; ?>
</div>
</div>


<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>

