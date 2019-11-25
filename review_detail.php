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

//review_idの取得
if(isset($_GET['id'])){
    $review_id = htmlspecialchars($_GET["id"]);
}else{
    header("Location: mypage.php");
}
try{
    //レビューを取得する
    $stm = db_prepare($dbh,'SELECT reviews.*, albums.jacket, albums.title, albums.year, artist.artist_name FROM reviews left join albums 
        on reviews.album_id = albums.id left join artist on albums.artist_id = artist.id WHERE reviews.id = :rid');
        db_execute($stm,array($review_id));
    $resultreview = db_fetch($stm);
    //print_r($resultreview);
}catch (PDOException $e){
	print('Error:'.$e->getMessage());
	die();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>レビュー修正・削除</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="./css/acdc.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<script type="text/javascript">
<!--

function DeleteConfirm(){

	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('削除します。よろしいですか')){

        location.href = "review_delete.php";
        return true;
	}else{
        return false;
    }
}

// -->
</script>
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>
<h2 class="col-lg-8 col-lg-offset-2">
    <div>レビュー修正・削除</div>
</h2>
<p style="height:15px;"></p>
<div class="col-xs-6 col-xs-offset-3 well">
<form action="review_modify.php" method="post">
    <div class="form-group">
        <label>アーティスト</label>
        <input class="form-control" value="<?= $resultreview[0]['artist_name'] ?>" readonly></input>
    </div>
    <div class="form-group">
        <label>アルバムタイトル</label>
        <input class="form-control" value="<?= $resultreview[0]['title'] ?>" readonly></input>
    </div>
    <div class="form-group">
        <label>発表年</label>
        <input class="form-control" value="<?= $resultreview[0]['year'] ?>" readonly></input>
    </div>
    <div class="form-group">
        <label>採点</label>
        <select name="score" class="form-control">
            <?php
                for ($i=0; $i <= 100; $i++) {
                    if ($i == $resultreview[0]['score']){
                        $slcscore = "selected";
                    }else{
                        $slcscore = "";
                    }
                    echo "<option value='". $i ."'" . $slcscore . " >" . $i . "点</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>レビュー</label>
        <textarea class="form-control" name="message"><?= htmlspecialchars($resultreview[0]['message']) ?></textarea>
    </div>
    <input type="hidden" name="review_id" value="<?= $review_id ?>">
    <input type="submit" name="modify" value="登録" />
    <button name="delete" onclick="return DeleteConfirm()">削除</button>
</form>
</div>
<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>