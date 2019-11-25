<?php
session_start();

header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//データベース接続
require_once("./functions/dbfunctions.php");
$dbh = db_connect();

//アーティスト一覧を取得
$stm = db_prepare($dbh,'SELECT id, artist_name FROM artist WHERE flag =1');
$stm -> execute();
$artist = db_fetch($stm);
?>

<!DOCTYPE html>
<html>
<head>
<title>アルバム登録</title>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/layout.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<?php include(dirname(__FILE__).'/layout/header.html'); ?>

<h1 class="col-xs-6 col-xs-offset-3">アルバム登録</h1>
<div class="col-xs-6 col-xs-offset-3 well">
    <form action="album_insert.php" method="post">
        <div class="form-group">
            <label>タイトル</label>
            <input type="text" name="title" class="form-control" id="input_title">
        </div>
        <div class="form-group">
            <label>アーティスト</label>
            <select name="artist_id" class="form-control" id="input_artist_id">
            <?php
                foreach($artist as $artist_val){
                    print "<option value='". $artist_val['id'] .= "'>". $artist_val['artist_name']. "</option>";
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for=input_year>発表年</label>
            <input type="text" name="year" size="50" class="form-control" id="input_year" placeholder="数字のみ入力">
        </div>
        <div class="form-group">
            <label for=input_jacket>アルバム画像</label>
            <input type="text" name="jacket" class="form-control" id="input_jacket" placeholder="画像ファイルの名前を拡張子まで入力">
        </div>
        <div class="form-group">
            <label for=input_genre>ジャンル</label>
            <input type="text" name="genre"class="form-control" id="input_genre">
        </div>
        <div class="form-group">
            <label for=input_disc1_1>Disc1 No1</label>
            <input type="text" name="disc1_1" class="form-control" id="input_disc1_1">
        </div>
        <div class="form-group">
            <label for=input_disc1_2>Disc1 No2</label>
            <input type="text" name="disc1_2" size="50" class="form-control" id="input_disc1_2">
        </div>
        <div class="form-group">
            <label for=input_disc1_3>Disc1 No3</label>
            <input type="text" name="disc1_3" size="50" class="form-control" id="input_disc1_3">
        </div>
        <div class="form-group">
            <label for=input_disc1_4>Disc1 No4</label>
            <input type="text" name="disc1_4" size="50" class="form-control" id="input_disc1_4">
        </div>
        <div class="form-group">
            <label for=input_disc1_5>Disc1 No5</label>
            <input type="text" name="disc1_5" size="50" class="form-control" id="input_disc1_5">
        </div>
        <div class="form-group">
            <label for=input_disc1_6>Disc1 No6</label>
            <input type="text" name="disc1_6" size="50" class="form-control" id="input_disc1_6">
        </div>
        <div class="form-group">
            <label for=input_disc1_7>Disc1 No7</label>
            <input type="text" name="disc1_7" size="50" class="form-control" id="input_disc1_7">
        </div>
        <div class="form-group">
            <label for=input_disc1_8>Disc1 No8</label>
            <input type="text" name="disc1_8" size="50" class="form-control" id="input_disc1_8">
        </div>
        <div class="form-group">
            <label for=input_disc1_9>Disc1 No9</label>
            <input type="text" name="disc1_9" size="50" class="form-control" id="input_disc1_9">
        </div>
        <div class="form-group">
            <label for=input_disc1_10>Disc1 No10</label>
            <input type="text" name="disc1_10" size="50" class="form-control" id="input_disc1_10">
        </div>
        <div class="form-group">
            <label for=input_disc1_11>Disc1 No11</label>
            <input type="text" name="disc1_11" size="50" class="form-control" id="input_disc1_11">
        </div>
        <div class="form-group">
            <label for=input_disc1_12>Disc1 No12</label>
            <input type="text" name="disc1_12" size="50" class="form-control" id="input_disc1_12">
        </div>
        <div class="form-group">
            <label for=input_disc1_13>Disc1 No13</label>
            <input type="text" name="disc1_13" size="50" class="form-control" id="input_disc1_13">
        </div>
        <div class="form-group">
            <label for=input_disc1_14>Disc1 No14</label>
            <input type="text" name="disc1_14" size="50" class="form-control" id="input_disc1_14">
        </div>
        <div class="form-group">
            <label for=input_disc1_15>Disc1 No15</label>
            <input type="text" name="disc1_15" size="50" class="form-control" id="input_disc1_15">
        </div>
        <div class="form-group">
            <label for=input_disc1_16>Disc1 No16</label>
            <input type="text" name="disc1_16" size="50" class="form-control" id="input_disc1_16">
        </div>
        <div class="form-group">
            <label for=input_disc1_17>Disc1 No17</label>
            <input type="text" name="disc1_17" size="50" class="form-control" id="input_disc1_17">
        </div>
        <div class="form-group">
            <label for=input_disc1_18>Disc1 No18</label>
            <input type="text" name="disc1_18" size="50" class="form-control" id="input_disc1_18">
        </div>
        <div class="form-group">
            <label for=input_disc1_19>Disc1 No19</label>
            <input type="text" name="disc1_19" size="50" class="form-control" id="input_disc1_19">
        </div>
        <div class="form-group">
            <label for=input_disc1_20>Disc1 No20</label>
            <input type="text" name="disc1_20" size="50" class="form-control" id="input_disc1_20">
        </div>
        <div class="form-group">
            <label for=input_disc2_1>Disc2 No1</label>
            <input type="text" name="disc2_1" size="50" class="form-control" id="input_disc2_1">
        </div>
        <div class="form-group">
            <label for=input_disc2_2>Disc2 No2</label>
            <input type="text" name="disc2_2" size="50" class="form-control" id="input_disc2_2">
        </div>
        <div class="form-group">
            <label for=input_disc2_3>Disc2 No3</label>
            <input type="text" name="disc2_3" size="50" class="form-control" id="input_disc2_3">
        </div>
        <div class="form-group">
            <label for=input_disc2_4>Disc2 No4</label>
            <input type="text" name="disc2_4" size="50" class="form-control" id="input_disc2_4">
        </div>
        <div class="form-group">
            <label for=input_disc2_5>Disc1 No5</label>
            <input type="text" name="disc2_5" size="50" class="form-control" id="input_disc2_5">
        </div>
        <div class="form-group">
            <label for=input_disc2_6>Disc2 No6</label>
            <input type="text" name="disc2_6" size="50" class="form-control" id="input_disc2_6">
        </div>
        <div class="form-group">
            <label for=input_disc2_7>Disc2 No7</label>
            <input type="text" name="disc2_7" size="50" class="form-control" id="input_disc2_7">
        </div>
        <div class="form-group">
            <label for=input_disc2_8>Disc2 No8</label>
            <input type="text" name="disc2_8" size="50" class="form-control" id="input_disc2_8">
        </div>
        <div class="form-group">
            <label for=input_disc2_9>Disc2 No9</label>
            <input type="text" name="disc2_9" size="50" class="form-control" id="input_disc2_9">
        </div>
        <div class="form-group">
            <label for=input_disc2_10>Disc2 No10</label>
            <input type="text" name="disc2_10" size="50" class="form-control" id="input_disc2_10">
        </div>
        <div class="form-group">
            <label for=input_disc2_11>Disc2 No11</label>
            <input type="text" name="disc2_11" size="50" class="form-control" id="input_disc2_11">
        </div>
        <div class="form-group">
            <label for=input_disc2_12>Disc2 No12</label>
            <input type="text" name="disc2_12" size="50" class="form-control" id="input_disc2_12">
        </div>
        <div class="form-group">
            <label for=input_disc2_13>Disc2 No13</label>
            <input type="text" name="disc2_13" size="50" class="form-control" id="input_disc2_13">
        </div>
        <div class="form-group">
            <label for=input_disc2_14>Disc2 No14</label>
            <input type="text" name="disc2_14" size="50" class="form-control" id="input_disc2_14">
        </div>
        <div class="form-group">
            <label for=input_disc2_15>Disc2 No15</label>
            <input type="text" name="disc2_15" size="50" class="form-control" id="input_disc2_15">
        </div>
        <div class="form-group">
            <label for=input_disc2_16>Disc2 No16</label>
            <input type="text" name="disc2_16" size="50" class="form-control" id="input_disc2_16">
        </div>
        <div class="form-group">
            <label for=input_disc2_17>Disc2 No17</label>
            <input type="text" name="disc2_17" size="50" class="form-control" id="input_disc2_17">
        </div>
        <div class="form-group">
            <label for=input_disc2_18>Disc2 No18</label>
            <input type="text" name="disc2_18" size="50" class="form-control" id="input_disc2_18">
        </div>
        <div class="form-group">
            <label for=input_disc2_19>Disc2 No19</label>
            <input type="text" name="disc2_19" size="50" class="form-control" id="input_disc2_19">
        </div>
        <div class="form-group">
            <label for=input_disc2_20>Disc2 No20</label>
            <input type="text" name="disc2_20" size="50" class="form-control" id="input_disc2_20">
        </div>
        <div class="form-group">
            <label for=input_disc3_1>Disc3 No1</label>
            <input type="text" name="disc3_1" size="50" class="form-control" id="input_disc3_1">
        </div>
        <div class="form-group">
            <label for=input_disc3_2>Disc3 No2</label>
            <input type="text" name="disc3_2" size="50" class="form-control" id="input_disc3_2">
        </div>
        <div class="form-group">
            <label for=input_disc3_3>Disc3 No3</label>
            <input type="text" name="disc3_3" size="50" class="form-control" id="input_disc3_3">
        </div>
        <div class="form-group">
            <label for=input_disc3_4>Disc3 No4</label>
            <input type="text" name="disc3_4" size="50" class="form-control" id="input_disc3_4">
        </div>
        <div class="form-group">
            <label for=input_disc3_5>Disc1 No5</label>
            <input type="text" name="disc3_5" size="50" class="form-control" id="input_disc3_5">
        </div>
        <div class="form-group">
            <label for=input_disc3_6>Disc3 No6</label>
            <input type="text" name="disc3_6" size="50" class="form-control" id="input_disc3_6">
        </div>
        <div class="form-group">
            <label for=input_disc3_7>Disc3 No7</label>
            <input type="text" name="disc3_7" size="50" class="form-control" id="input_disc3_7">
        </div>
        <div class="form-group">
            <label for=input_disc3_8>Disc3 No8</label>
            <input type="text" name="disc3_8" size="50" class="form-control" id="input_disc3_8">
        </div>
        <div class="form-group">
            <label for=input_disc3_9>Disc3 No9</label>
            <input type="text" name="disc3_9" size="50" class="form-control" id="input_disc3_9">
        </div>
        <div class="form-group">
            <label for=input_disc3_10>Disc3 No10</label>
            <input type="text" name="disc3_10" size="50" class="form-control" id="input_disc3_10">
        </div>
        <div class="form-group">
            <label for=input_disc3_11>Disc3 No11</label>
            <input type="text" name="disc3_11" size="50" class="form-control" id="input_disc3_11">
        </div>
        <div class="form-group">
            <label for=input_disc3_12>Disc3 No12</label>
            <input type="text" name="disc3_12" size="50" class="form-control" id="input_disc3_12">
        </div>
        <div class="form-group">
            <label for=input_disc3_13>Disc3 No13</label>
            <input type="text" name="disc3_13" size="50" class="form-control" id="input_disc3_13">
        </div>
        <div class="form-group">
            <label for=input_disc3_14>Disc3 No14</label>
            <input type="text" name="disc3_14" size="50" class="form-control" id="input_disc3_14">
        </div>
        <div class="form-group">
            <label for=input_disc3_15>Disc3 No15</label>
            <input type="text" name="disc3_15" size="50" class="form-control" id="input_disc3_15">
        </div>
        <div class="form-group">
            <label for=input_disc3_16>Disc3 No16</label>
            <input type="text" name="disc3_16" size="50" class="form-control" id="input_disc3_16">
        </div>
        <div class="form-group">
            <label for=input_disc3_17>Disc3 No17</label>
            <input type="text" name="disc3_17" size="50" class="form-control" id="input_disc3_17">
        </div>
        <div class="form-group">
            <label for=input_disc3_18>Disc3 No18</label>
            <input type="text" name="disc3_18" size="50" class="form-control" id="input_disc3_18">
        </div>
        <div class="form-group">
            <label for=input_disc3_19>Disc3 No19</label>
            <input type="text" name="disc3_19" size="50" class="form-control" id="input_disc3_19">
        </div>
        <div class="form-group">
            <label for=input_disc3_20>Disc3 No20</label>
            <input type="text" name="disc3_20" size="50" class="form-control" id="input_disc3_20">
        </div>
        <div class="form-group">
            <label for=input_disc4_1>Disc4 No1</label>
            <input type="text" name="disc4_1" size="50" class="form-control" id="input_disc4_1">
        </div>
        <div class="form-group">
            <label for=input_disc4_2>Disc4 No2</label>
            <input type="text" name="disc4_2" size="50" class="form-control" id="input_disc4_2">
        </div>
        <div class="form-group">
            <label for=input_disc4_3>Disc4 No3</label>
            <input type="text" name="disc4_3" size="50" class="form-control" id="input_disc4_3">
        </div>
        <div class="form-group">
            <label for=input_disc4_4>Disc4 No4</label>
            <input type="text" name="disc4_4" size="50" class="form-control" id="input_disc4_4">
        </div>
        <div class="form-group">
            <label for=input_disc4_5>Disc1 No5</label>
            <input type="text" name="disc4_5" size="50" class="form-control" id="input_disc4_5">
        </div>
        <div class="form-group">
            <label for=input_disc4_6>Disc4 No6</label>
            <input type="text" name="disc4_6" size="50" class="form-control" id="input_disc4_6">
        </div>
        <div class="form-group">
            <label for=input_disc4_7>Disc4 No7</label>
            <input type="text" name="disc4_7" size="50" class="form-control" id="input_disc4_7">
        </div>
        <div class="form-group">
            <label for=input_disc4_8>Disc4 No8</label>
            <input type="text" name="disc4_8" size="50" class="form-control" id="input_disc4_8">
        </div>
        <div class="form-group">
            <label for=input_disc4_9>Disc4 No9</label>
            <input type="text" name="disc4_9" size="50" class="form-control" id="input_disc4_9">
        </div>
        <div class="form-group">
            <label for=input_disc4_10>Disc4 No10</label>
            <input type="text" name="disc4_10" size="50" class="form-control" id="input_disc4_10">
        </div>
        <div class="form-group">
            <label for=input_disc4_11>Disc4 No11</label>
            <input type="text" name="disc4_11" size="50" class="form-control" id="input_disc4_11">
        </div>
        <div class="form-group">
            <label for=input_disc4_12>Disc4 No12</label>
            <input type="text" name="disc4_12" size="50" class="form-control" id="input_disc4_12">
        </div>
        <div class="form-group">
            <label for=input_disc4_13>Disc4 No13</label>
            <input type="text" name="disc4_13" size="50" class="form-control" id="input_disc4_13">
        </div>
        <div class="form-group">
            <label for=input_disc4_14>Disc4 No14</label>
            <input type="text" name="disc4_14" size="50" class="form-control" id="input_disc4_14">
        </div>
        <div class="form-group">
            <label for=input_disc4_15>Disc4 No15</label>
            <input type="text" name="disc4_15" size="50" class="form-control" id="input_disc4_15">
        </div>
        <div class="form-group">
            <label for=input_disc4_16>Disc4 No16</label>
            <input type="text" name="disc4_16" size="50" class="form-control" id="input_disc4_16">
        </div>
        <div class="form-group">
            <label for=input_disc4_17>Disc4 No17</label>
            <input type="text" name="disc4_17" size="50" class="form-control" id="input_disc4_17">
        </div>
        <div class="form-group">
            <label for=input_disc4_18>Disc4 No18</label>
            <input type="text" name="disc4_18" size="50" class="form-control" id="input_disc4_18">
        </div>
        <div class="form-group">
            <label for=input_disc4_19>Disc4 No19</label>
            <input type="text" name="disc4_19" size="50" class="form-control" id="input_disc4_19">
        </div>
        <div class="form-group">
            <label for=input_disc4_20>Disc4 No20</label>
            <input type="text" name="disc4_20" size="50" class="form-control" id="input_disc4_20">
        </div>
        <input type="submit" value="登録" class="btn btn-default">
    </form>
</div>
<?php include(dirname(__FILE__).'/layout/footer.html'); ?>
</body>
</html>