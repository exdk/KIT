<?php
session_start();
include '../config.php';
$title = 'forKIT | Панель управления';
include '../style/head.php';
if (isset($_SESSION['user_id']))
{
	$result1 = $mysqli->query("SELECT * FROM users WHERE id='{$_SESSION['user_id']}'");
	$row1 = $result1->fetch_assoc();
	if ($row1['level'] != 2) {
		header("Location: http://yunusov.me/forKIT/error.php");
	}
}
else {
	header("Location: http://yunusov.me/forKIT/error.php");
}
echo'<div class="bordur">Панель управления</div><div class="main">
<div class="link"><a href="see.php?act"><img src="http://yunusov.me/forKIT/style/img/1.gif" alt="»" /> Режим редактирования данных</a><br/></div>';
echo'</div>';
include"../style/foot.php";
?>
