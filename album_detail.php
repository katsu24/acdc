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

//アルバムIDを取得
if(isset($_GET['id'])){
    $albumid = htmlspecialchars($_GET["id"]);
}else{
    header("Location: album_list.php");
	exit();
}

try{
    //アルバム情報を取得する
    $stm = db_prepare($dbh,'SELECT *, artist.artist_name from albums inner join artist on albums.artist_id = artist.id where albums.id = (:albumid)');
    db_execute($stm,array($albumid));
    $resultalbum = db_fetch($stm);
    //print_r($resultalbum);
    //登録ユーザのレビュー平均採点を取得する
    $stm = db_prepare($dbh,'SELECT truncate(avg(score), 1) as avgscore from reviews where flag = 1 and album_id = :id and member = 1');
    db_execute($stm,array($albumid));
    $resultrb = db_fetch($stm);
    if($resultrb!=null){
        $avg = $resultrb[0]['avgscore'];
    }

}catch (PDOException $e){
	print('Error:'.$e->getMessage());
	die();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=  $resultalbum[0]['title'] ?></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/acdc.css">
    <link rel="stylesheet" href="css/layout.css">
</head>

<body>
    <?php include(dirname(__FILE__).'/layout/header.html'); ?>
    <p style="height:5px;"></p>
    <div class="wrapper">
        <main class="jacket">
            <img src="images/jackets/<?php isset($resultalbum[0]['jacket']) ? print $resultalbum[0]['jacket'] : print 'noimage.jpg' ?>" alt="live" class="jacket">
        </main>

            <div class="song">
                <?php isset($resultalbum[0]['disc2_1']) ? print "<h3>Disc 1</h3>" : '' ?>
                <ol>
                    <?php isset($resultalbum[0]['disc1_1']) ? print "<li>" . $resultalbum[0]['disc1_1'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_2']) ? print "<li>" . $resultalbum[0]['disc1_2'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_3']) ? print "<li>" . $resultalbum[0]['disc1_3'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_4']) ? print "<li>" . $resultalbum[0]['disc1_4'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_5']) ? print "<li>" . $resultalbum[0]['disc1_5'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_6']) ? print "<li>" . $resultalbum[0]['disc1_6'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_7']) ? print "<li>" . $resultalbum[0]['disc1_7'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_8']) ? print "<li>" . $resultalbum[0]['disc1_8'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_9']) ? print "<li>" . $resultalbum[0]['disc1_9'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_10']) ? print "<li>" . $resultalbum[0]['disc1_10'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_11']) ? print "<li>" . $resultalbum[0]['disc1_11'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_12']) ? print "<li>" . $resultalbum[0]['disc1_12'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_13']) ? print "<li>" . $resultalbum[0]['disc1_13'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_14']) ? print "<li>" . $resultalbum[0]['disc1_14'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_15']) ? print "<li>" . $resultalbum[0]['disc1_15'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_16']) ? print "<li>" . $resultalbum[0]['disc1_16'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_17']) ? print "<li>" . $resultalbum[0]['disc1_17'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_18']) ? print "<li>" . $resultalbum[0]['disc1_18'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_19']) ? print "<li>" . $resultalbum[0]['disc1_19'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc1_20']) ? print "<li>" . $resultalbum[0]['disc1_20'] . "</li>" : '' ?>
                </ol>
                <?php isset($resultalbum[0]['disc2_1']) ? print "<h3>Disc 2</h3>" : '' ?>
                <ol>
                    <?php isset($resultalbum[0]['disc2_1']) ? print "<li>" . $resultalbum[0]['disc2_1'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_2']) ? print "<li>" . $resultalbum[0]['disc2_2'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_3']) ? print "<li>" . $resultalbum[0]['disc2_3'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_4']) ? print "<li>" . $resultalbum[0]['disc2_4'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_5']) ? print "<li>" . $resultalbum[0]['disc2_5'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_6']) ? print "<li>" . $resultalbum[0]['disc2_6'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_7']) ? print "<li>" . $resultalbum[0]['disc2_7'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_8']) ? print "<li>" . $resultalbum[0]['disc2_8'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_9']) ? print "<li>" . $resultalbum[0]['disc2_9'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_10']) ? print "<li>" . $resultalbum[0]['disc2_10'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_11']) ? print "<li>" . $resultalbum[0]['disc2_11'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_12']) ? print "<li>" . $resultalbum[0]['disc2_12'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_13']) ? print "<li>" . $resultalbum[0]['disc2_13'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_14']) ? print "<li>" . $resultalbum[0]['disc2_14'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_15']) ? print "<li>" . $resultalbum[0]['disc2_15'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_16']) ? print "<li>" . $resultalbum[0]['disc2_16'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_17']) ? print "<li>" . $resultalbum[0]['disc2_17'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_18']) ? print "<li>" . $resultalbum[0]['disc2_18'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_19']) ? print "<li>" . $resultalbum[0]['disc2_19'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc2_20']) ? print "<li>" . $resultalbum[0]['disc2_20'] . "</li>" : '' ?>
                </ol>
                <?php isset($resultalbum[0]['disc3_1']) ? print "<h3>Disc 3</h3>" : '' ?>
                <ol>
                    <?php isset($resultalbum[0]['disc3_1']) ? print "<li>" . $resultalbum[0]['disc3_1'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_2']) ? print "<li>" . $resultalbum[0]['disc3_2'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_3']) ? print "<li>" . $resultalbum[0]['disc3_3'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_4']) ? print "<li>" . $resultalbum[0]['disc3_4'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_5']) ? print "<li>" . $resultalbum[0]['disc3_5'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_6']) ? print "<li>" . $resultalbum[0]['disc3_6'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_7']) ? print "<li>" . $resultalbum[0]['disc3_7'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_8']) ? print "<li>" . $resultalbum[0]['disc3_8'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_9']) ? print "<li>" . $resultalbum[0]['disc3_9'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_10']) ? print "<li>" . $resultalbum[0]['disc3_10'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_11']) ? print "<li>" . $resultalbum[0]['disc3_11'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_12']) ? print "<li>" . $resultalbum[0]['disc3_12'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_13']) ? print "<li>" . $resultalbum[0]['disc3_13'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_14']) ? print "<li>" . $resultalbum[0]['disc3_14'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_15']) ? print "<li>" . $resultalbum[0]['disc3_15'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_16']) ? print "<li>" . $resultalbum[0]['disc3_16'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_17']) ? print "<li>" . $resultalbum[0]['disc3_17'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_18']) ? print "<li>" . $resultalbum[0]['disc3_18'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_19']) ? print "<li>" . $resultalbum[0]['disc3_19'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc3_20']) ? print "<li>" . $resultalbum[0]['disc3_20'] . "</li>" : '' ?>
                </ol>
                <?php isset($resultalbum[0]['disc4_1']) ? print "<h3>Disc 4</h3>" : '' ?>
                <ol>
                    <?php isset($resultalbum[0]['disc4_1']) ? print "<li>" . $resultalbum[0]['disc4_1'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_2']) ? print "<li>" . $resultalbum[0]['disc4_2'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_3']) ? print "<li>" . $resultalbum[0]['disc4_3'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_4']) ? print "<li>" . $resultalbum[0]['disc4_4'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_5']) ? print "<li>" . $resultalbum[0]['disc4_5'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_6']) ? print "<li>" . $resultalbum[0]['disc4_6'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_7']) ? print "<li>" . $resultalbum[0]['disc4_7'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_8']) ? print "<li>" . $resultalbum[0]['disc4_8'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_9']) ? print "<li>" . $resultalbum[0]['disc4_9'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_10']) ? print "<li>" . $resultalbum[0]['disc4_10'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_11']) ? print "<li>" . $resultalbum[0]['disc4_11'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_12']) ? print "<li>" . $resultalbum[0]['disc4_12'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_13']) ? print "<li>" . $resultalbum[0]['disc4_13'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_14']) ? print "<li>" . $resultalbum[0]['disc4_14'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_15']) ? print "<li>" . $resultalbum[0]['disc4_15'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_16']) ? print "<li>" . $resultalbum[0]['disc4_16'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_17']) ? print "<li>" . $resultalbum[0]['disc4_17'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_18']) ? print "<li>" . $resultalbum[0]['disc4_18'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_19']) ? print "<li>" . $resultalbum[0]['disc4_19'] . "</li>" : '' ?>
                    <?php isset($resultalbum[0]['disc4_20']) ? print "<li>" . $resultalbum[0]['disc4_20'] . "</li>" : '' ?>
                </ol>
            </div>

        <div class="title">
            <h1><?=  $resultalbum[0]['title'] ?></h1>
            <div class="year">
                <p><?=  $resultalbum[0]['year'] ?></p><br>
                <hr>
            </div>
        </div>


    <div class="avg">
        <?php
            echo $avg;
        ?>
    </div>

        <div class="form">
        <form action="album_review_chk.php" method="post">
            <input type="hidden" name="member" value="<?php isset($_SESSION['name']) ? print 1 : print 0 ?>">
            <input type="hidden" name="member_id" value="<?php isset($_SESSION['member_id']) ? print $_SESSION['member_id'] : '' ?>">
            <input type="hidden" name="album_id" value="<?php print $albumid ?>">
            <p>お名前</p>
                <input type="text" name="name" value="<?php isset($_SESSION['name']) ? print $_SESSION['name'] : '' ?>">
            <p>レビュー</p>
                <textarea name="message" rows="5" cols="53"></textarea>
            <p>
            採点！<br>
            <select class="textline" name="score">
                <option value="0">0点</option>
                <option value="1">1点</option>
                <option value="2">2点</option>
                <option value="3">3点</option>
                <option value="4">4点</option>
                <option value="5">5点</option>
                <option value="6">6点</option>
                <option value="7">7点</option>
                <option value="8">8点</option>
                <option value="9">9点</option>
                <option value="10">10点</option>
                <option value="11">11点</option>
                <option value="12">12点</option>
                <option value="13">13点</option>
                <option value="14">14点</option>
                <option value="15">15点</option>
                <option value="16">16点</option>
                <option value="17">17点</option>
                <option value="18">18点</option>
                <option value="19">19点</option>
                <option value="20">20点</option>
                <option value="21">21点</option>
                <option value="22">22点</option>
                <option value="23">23点</option>
                <option value="24">24点</option>
                <option value="25">25点</option>
                <option value="26">26点</option>
                <option value="27">27点</option>
                <option value="28">28点</option>
                <option value="29">29点</option>
                <option value="30">30点</option>
                <option value="31">31点</option>
                <option value="32">32点</option>
                <option value="33">33点</option>
                <option value="34">34点</option>
                <option value="35">35点</option>
                <option value="36">36点</option>
                <option value="37">37点</option>
                <option value="38">38点</option>
                <option value="39">39点</option>
                <option value="40">40点</option>
                <option value="41">41点</option>
                <option value="42">42点</option>
                <option value="43">43点</option>
                <option value="44">44点</option>
                <option value="45">45点</option>
                <option value="46">46点</option>
                <option value="47">47点</option>
                <option value="48">48点</option>
                <option value="49">49点</option>
                <option value="50">50点</option>
                <option value="51">51点</option>
                <option value="52">52点</option>
                <option value="53">53点</option>
                <option value="54">54点</option>
                <option value="55">55点</option>
                <option value="56">56点</option>
                <option value="57">57点</option>
                <option value="58">58点</option>
                <option value="59">59点</option>
                <option value="60">60点</option>
                <option value="61">61点</option>
                <option value="62">62点</option>
                <option value="63">63点</option>
                <option value="64">64点</option>
                <option value="65">65点</option>
                <option value="66">66点</option>
                <option value="67">67点</option>
                <option value="68">68点</option>
                <option value="69">69点</option>
                <option value="70">70点</option>
                <option value="71">71点</option>
                <option value="72">72点</option>
                <option value="73">73点</option>
                <option value="74">74点</option>
                <option value="75">75点</option>
                <option value="76">76点</option>
                <option value="77">77点</option>
                <option value="78">78点</option>
                <option value="79">79点</option>
                <option value="80">80点</option>
                <option value="81">81点</option>
                <option value="82">82点</option>
                <option value="83">83点</option>
                <option value="84">84点</option>
                <option value="85">85点</option>
                <option value="86">86点</option>
                <option value="87">87点</option>
                <option value="88">88点</option>
                <option value="89">89点</option>
                <option value="90">90点</option>
                <option value="91">91点</option>
                <option value="92">92点</option>
                <option value="93">93点</option>
                <option value="94">94点</option>
                <option value="95">95点</option>
                <option value="96">96点</option>
                <option value="97">97点</option>
                <option value="98">98点</option>
                <option value="99">99点</option>
                <option value="100">100点</option>

            </select>

                <input type="submit" value="送信"><br>
                <hr>
        </p>
        </form>
        </div>


    <div class="comment">
        <?php
        $stm = db_prepare($dbh, "SELECT @n:=@n+1 as nm, t1.* FROM (SELECT * FROM reviews where flag =1 and album_id = (:albumid)) t1, (SELECT @n:=0) t2 ORDER BY id DESC");
        db_execute($stm,array($albumid));
        $resultrb = db_fetch($stm);
        ?>

        <?php foreach($resultrb as $row): ?>
        <span class="name"><?php echo htmlspecialchars($row['nm']) ?></span>
        <span class="name"><?php isset($row['member_id']) ? print "<a href='reviewer_detail.php?member_id=" . $row['member_id'] . "'>" . htmlspecialchars($row['name']) . "</a>" : print htmlspecialchars($row['name'])  ?></span>
        <span class="name"><?php echo htmlspecialchars($row['updated_at']) ?></span>
        <div class="score"><?php echo htmlspecialchars($row['score']) ?></div><br/>
        <textarea class="message"><?php echo htmlspecialchars($row['message']) ?></textarea>
        <hr>
        <?php endforeach; ?>
    </div>





    <div class="clear"></div>
    </div>
    <footer class="footer">
    </footer>

</body>
<?php
    $dbh = null;
?>
</html>