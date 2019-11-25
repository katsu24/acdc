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

//member_idの取得
if(isset($_GET['member_id'])){
    $member_id = htmlspecialchars($_GET["member_id"]);
}else{
    header("Location: index.php");
}

try{
    //レビュー一覧を取得する
    $stm = db_prepare($dbh,'SELECT reviews.*, albums.jacket, albums.title, albums.year, artist.artist_name FROM reviews left join albums 
        on reviews.album_id = albums.id left join artist on albums.artist_id = artist.id WHERE reviews.flag = 1 and reviews.member_id = :mid 
        Order By reviews.score DESC, artist.artist_name');
        db_execute($stm,array($member_id));
    $resultreviews = db_fetch($stm);
    //レビュー数‘を取得する
    $stm = db_prepare($dbh,'SELECT count(*) AS cnt FROM reviews WHERE flag = 1 and member_id = :mid');
        db_execute($stm,array($member_id));
    $reviewscnt = db_fetch($stm);


    //print_r($resultreviews);
    //print_r($reviewscnt);
}catch (PDOException $e){
	print('Error:'.$e->getMessage());
	die();
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?= $resultreviews[0]['name'] ?>さんのレビュー一覧</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="./css/acdc.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>
<h2 class="col-lg-8 col-lg-offset-2">
    <div class="reviewername">
        <?= $resultreviews[0]['name'] ?>さんのレビュー一覧
    </div>
</h2>
<h3 class="col-lg-8 col-lg-offset-2">
    <div class="reviewcnt">
        <?= $reviewscnt[0]['cnt'] ?>
    </div>
    <div style="width:110px;display:inline-block;">レビュー</div>
</h3>
<p style="height:15px;"></p>
<div class="col-lg-8 col-lg-offset-2">
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>アルバムタイトル</th>
            <th>アーティスト</th>
            <th>発表年</th>
            <th>採点</th>
        </tr>
    </thead>
    <tbody>
            <?php foreach($resultreviews as $row): ?>
            <tr>
                <td rowspan="2"><img src="images/jackets/<?php isset($row['jacket']) ? print $row['jacket'] : print 'noimage.jpg' ?>" class="jacket-list2"></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['artist_name']) ?></td>
                <td><?= htmlspecialchars($row['year']) ?></td>
                <td><?= htmlspecialchars($row['score']) ?></td>
            </tr>
            <tr>
                <td colspan="4"><textarea class="reviewmessage" readonly><?= htmlspecialchars($row['message']) ?></textarea></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>