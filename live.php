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


try{
    //アルバム情報を取得する

    //レビュー情報を取得する
    $stm = db_prepare($dbh,'SELECT truncate(avg(score), 1) as avgscore from reviews where id = 1');
    $stm->execute();
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
    <title>Live</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/acdc.css">
</head>

<body>
    <header class="header">
        <h1><img src="images/logo.jpg" width="217" height="89" alt="acdc"></h1>
        <nav id="global_navi">
        <ul>
            <li>アーティスト</li>
            <li><a href="album(acdc).html">アルバム</a></li>
        </ul>
        </nav> 
    </header>
    <div class="wrapper">
        <main class="jacket">
            <img src="images/live.jpg" alt="live" class="jacket">
        </main>

            <div class="song">
              <h3>Disc 1</h3>  
                <ol>
                    <li>Thunderstruck</li>
                    <li>Shoot To Thrill</li>
                    <li>Back In Black</li>
                    <li>Sin City</li>
                    <li>Who Made Who</li>
                    <li>Heatseeker</li>
                    <li>Fire Your Guns</li>
                    <li>Jailbreak</li>
                    <li>The Jack</li>
                    <li>The Razor's Edge</li>
                    <li>Dirty Deeds Done Dirt Cheap</li>
                    <li>Moneytalks</li>
                </ol>
              <h3>Disc 2</h3>
                <ol>
                    <li>Hells Bells</li>
                    <li>Are You Ready</li>
                    <li>That's The Way I Wanna Rock 'N Roll</li>
                    <li>High Voltage</li>
                    <li>You Shook Me All Night Long</li>
                    <li>Whole Lotta Rosie</li>
                    <li>Let There Be Rock</li>
                    <li>Bonny</li>
                    <li>Highway To Hell</li>
                    <li>T.N.T.</li>
                    <li>For Those About To Rock (We Salute You)</li>
                </ol>
            </div>

        <div class="title">
            <h1>Live</h1>
            <div class="year">
                <p>1992</p><br>
                <hr>
            </div>
        </div>


    <div class="avg">
        <?php
            print_r ($avg);
        ?>  
    </div>

        <div class="form">
        <form action="sns2.php" method="post">
            <p>お名前</p>
                <input type="text" name="n">
            <p>レビュー</p>
                <textarea name="m" rows="5" cols="53"></textarea>
            <p>
            採点！<br>
            <select class="textline" name="点数">
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


    <div class="coment">
        <?php
        $stm = db_prepare($dbh, "SELECT * FROM reviews where album_id = 1 ORDER BY id DESC");
        $stm->execute();
        foreach (db_fetch($stm) as $r){
            printf ('<span class="ban">%d</span>
            <span class="name">%s</span>
            <span class="date">%s</span>
            <span class="score">%s</span>
            <span class="mes">%s</span>' , 
            $r['id'], $r['name'], $r['updated_at'], $r['score']."点","<br>"
            .nl2br($r['message'])."<hr>");
        }
        ?>
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