<?php
//error_reporting(0);
session_start();
require "../config.php";
$title = 'forKIT | Редактор';
require "../style/head.php";
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
echo'<div class="bordur">Панель управления</div><div class="main">';

$id = 0;
if(isset($_GET["id"]))
$id = mysqli_real_escape_string($mysqli, $_GET["id"]);
$mysqli->query("DELETE FROM categories WHERE parent_id='{$id}'");
$mysqli->query("DELETE FROM categories WHERE id='{$id}'");
$mysqli->close();
echo'</div><div class="menu">Категория удалена</div>
<div class="bordur"><a href="http://yunusov.me/forKIT/panel/see.php?act"><img src="http://yunusov.me/forKIT/style/img/2.gif" alt="»" /> Вернуться</a></div>';

echo '</div>';
require "../style/foot.php";