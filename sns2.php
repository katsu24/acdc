<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SNS2</title>
</head>
<body>

<?php
$my_nam=htmlspecialchars($_POST["n"], ENT_QUOTES);
$my_mes=htmlspecialchars($_POST["m"], ENT_QUOTES);
$my_score=htmlspecialchars($_POST["点数"],ENT_QUOTES);
$db = new PDO("mysql:host=localhost;dbname=acdc","root","");
$stmt = $db->prepare("INSERT INTO tb (ban,nam,mes,date,score) VALUES(NULL, ?, ?, NOW(), ?)");
$stmt->execute([$my_nam, $my_mes, $my_score]);

//$db->query("INSERT INTO tb (ban,nam,mes,dat,score) VALUES (NULL,'$my_nam','$my_mes',NOW(),'$my_score')");//
print "書き込みに成功！";
print "<p><a href='live.php'>一覧表示へ</a></p>";
?>

</body>
</html>
