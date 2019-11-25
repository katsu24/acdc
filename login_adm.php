<?php
session_start();

header("Content-type: text/html; charset=utf-8");

// ログイン状態のチェック
if (!isset($_SESSION["name"])) {
	header("Location: login_form.php");
	exit();
}

//$name = $_SESSION['name'];
//echo "<p>".htmlspecialchars($name,ENT_QUOTES)."さん、こんにちは！</p>";
header("Location: login_adm.php");
//echo "<a href='logout.php'>ログアウトする</a>";
exit();