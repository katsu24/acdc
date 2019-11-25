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

//検索キーワードの取得
//アルバムタイトル
if(isset($_GET['title'])){
    $title = htmlspecialchars($_GET["title"]);
}else{
    $title = "";
}
//アーティスト名
if(isset($_GET["artistname"])){
    $artistname = htmlspecialchars($_GET["artistname"]);
}else{
    $artistname = "";
}

//アーティストID
if(isset($_GET["aid"])){
    $aid = htmlspecialchars($_GET["aid"]);
}else{
    $aid = "";
}

//アーティストID
if(isset($_GET["year"])){
    $year = htmlspecialchars($_GET["year"]);
}else{
    $year = "";
}

$title = "%".$title."%";
$artistname = "%".$artistname."%";
//echo $title;
//echo $artistname;
//echo $aid;
//echo $year;

try{
    //アルバム一覧を取得する
    if(isset($_GET["aid"])){
        $stm = db_prepare($dbh,'SELECT albums.*, artist.artist_name, T3.avgscore, T4.cnt FROM albums left join artist 
        on albums.artist_id = artist.id left join (select album_id, truncate(avg(score), 1) as avgscore FROM reviews WHERE member = 1 group by album_id) 
        as T3 on albums.id = T3.album_id left join (select album_id, count(score) as cnt FROM reviews group by album_id) as T4 on albums.id = T4.album_id 
        WHERE artist.id = :aid Order By albums.year');
        db_execute($stm,array($aid));
    }elseif(isset($_GET["year"])){
        $stm = db_prepare($dbh,'SELECT albums.*, artist.artist_name, T3.avgscore, T4.cnt FROM albums left join artist 
        on albums.artist_id = artist.id left join (select album_id, truncate(avg(score), 1) as avgscore FROM reviews WHERE member = 1 group by album_id) 
        as T3 on albums.id = T3.album_id left join (select album_id, count(score) as cnt FROM reviews group by album_id) as T4 on albums.id = T4.album_id 
        WHERE albums.year = :year Order by T3.avgscore DESC, artist.artist_name');
        db_execute($stm,array($year));
    }else{
        $stm = db_prepare($dbh,'SELECT albums.*, artist.artist_name, T3.avgscore, T4.cnt FROM albums left join artist 
        on albums.artist_id = artist.id left join (select album_id, truncate(avg(score), 1) as avgscore FROM reviews WHERE member = 1 group by album_id) 
        as T3 on albums.id = T3.album_id left join (select album_id, count(score) as cnt FROM reviews group by album_id) as T4 on albums.id = T4.album_id 
        WHERE title collate utf8_unicode_ci like :title and artist_name collate utf8_unicode_ci like :artistname 
        order by artist.artist_name');
        db_execute($stm,array($title,$artistname));
    }
    $resultalbum = db_fetch($stm);
    //print_r($resultalbum);
}catch (PDOException $e){
	print('Error:'.$e->getMessage());
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>アルバム一覧</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="./css/acdc.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>
<?php if (isset($_GET["aid"])) : ?>
<h2 class="col-lg-8 col-lg-offset-2">
    <?php
        $stm = db_prepare($dbh,'SELECT * FROM artist WHERE artist.id = :aid');
        db_execute($stm,array($aid));
        $artist = db_fetch($stm);
        echo $artist[0]['artist_name'];
    ?>
</h2>
<?php elseif(isset($_GET["year"])) : ?>
<h2 class="col-lg-8 col-lg-offset-2">
    <?= $year ?>年
</h2>
<?php else : ?>
<h2 class="col-lg-8 col-lg-offset-2">検索結果</h2>
<div class="col-xs-6 col-xs-offset-3">検索条件&emsp;
<?php
    if(isset($_GET["artistname"])){
        echo "アーティスト名：" . $_GET["artistname"];
    }
    if(isset($_GET["title"])){
        echo "アルバム名：" . $_GET["title"];
    }
    ?>
</div>
<?php endif;?>
<div class="col-lg-8 col-lg-offset-2">
    <?php if(isset($resultalbum)): ?>
    <p class="alert alert-success"><?php echo count($resultalbum) ?>件見つかりました。</p>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>アーティスト</th>
                <th>アルバムタイトル</th>
                <th>発表年</th>
                <th>ジャンル</th>
                <th>平均<br/>レビュー<br/>点数</th>
                <th>レビュー数</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($resultalbum as $row): ?>
            <tr>
                <td><a href="album_detail.php?id=<?php echo htmlspecialchars($row['id']) ?>"><img src="images/jackets/<?php isset($row['jacket']) ? print $row['jacket'] : print 'noimage.jpg' ?>" class="jacket-list"></a></td>
                <td><a href="album_list.php?aid=<?php echo $row['artist_id'] ?>"><?php echo htmlspecialchars($row['artist_name']) ?></a></td>
                <td><a href="album_detail.php?id=<?php echo htmlspecialchars($row['id']) ?>"><?php echo htmlspecialchars($row['title']) ?></a></td>
                <td><a href="album_list.php?year=<?php echo $row['year'] ?>"><?php echo htmlspecialchars($row['year']) ?></a></td>
                <td><?php echo htmlspecialchars($row['genre']) ?></td>
                <td><?php echo htmlspecialchars($row['avgscore']) ?></td>
                <td><?php echo htmlspecialchars($row['cnt']) ?></td>
                <td><a href="album_detail.php?id=<?php echo htmlspecialchars($row['id']) ?>">詳細</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
		<p class="alert alert-danger">検索対象は見つかりませんでした。</p>
	<?php endif; ?>
</div>

<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>

<?php
    $dbh = null;
?>