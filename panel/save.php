<?php
error_reporting(0);
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
if(isset($_GET["id"])) {
$id = mysqli_real_escape_string($mysqli, $_GET["id"]);
}
if (isset($_POST)) {
$category = mysqli_real_escape_string($mysqli, $_POST["category"]);
}
$mysqli->query("UPDATE categories SET category = '{$category}' WHERE id='{$id}'");
	$result1 = $mysqli->query("SELECT * FROM categories WHERE id = {$id}");
	$row1 = $result1->fetch_assoc();
echo'</div><div class="menu">Изменения сохранены</div>
<div class="bordur"><a href="see.php?see='.$row1["parent_id"].'"><img src="http://yunusov.me/forKIT/style/img/2.gif" alt="»" /> Вернуться</a></div>';

echo '</div>';
require "../style/foot.php";