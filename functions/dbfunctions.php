<?php
//DB接続用関数
function db_connect() {
	$ini = parse_ini_file('./config.ini');
	$dsn = $ini['dsn'];
	$user = $ini['user'];
	$password = $ini['password'];

	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_EMULATE_PREPARES => false,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	);

	$pdo = new PDO($dsn, $user, $password,$options);
	return $pdo;
}

//トランザクション開始関数
function db_trans($pdo) {
	$pdo->beginTransaction();
}

//トランザクションコミット関数
function db_commit($pdo) {
	$pdo->commit();
}

//トランザクションロールバック関数
function db_rollback($pdo) {
	$pdo->rollback();
}

//SQL前処理関数
function db_prepare($pdo,$sql) {
	$stm = $pdo -> prepare($sql);
	return $stm;
}

//SQL実行関数
function db_execute($stm,$cols) {
	$stm ->execute($cols);
}

//抽出結果出力関数
function db_fetch($stm) {
	$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
	return $rows;
}

?>